<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BikeManagement\BikeBrand;
use App\Models\Backend\BikeManagement\BikeEngineSize;
use App\Models\Backend\BikeManagement\BikeMotorType;
use App\Models\Backend\BikeManagement\BikeYearVersion;
use App\Models\Backend\BikeManagement\MotorBike;
use App\Models\Backend\PartsManagement\PartsBrandCategory;
use App\Models\Backend\PartsManagement\PartsParentBrand;
use App\Models\Backend\PartsManagement\PartsProduct;
use Illuminate\Http\Request;
use function Laravel\Prompts\text;

class HomeProductController extends Controller
{
    protected $product, $products = [], $relatedProducts = [], $partsBrandCategory;
    public function product($brandId)
    {
        return view('frontend.product.index', [
            'brand'         => PartsParentBrand::select('id', 'name', 'description')->find($brandId),
            'categories'    => PartsBrandCategory::where([
                'parts_parent_brand_id'     => $brandId,
                'parts_brand_category_id'   => 0,
                'status'                    => 1,
            ])->select('id', 'parts_parent_brand_id', 'name', 'image')->get(),
        ]);
    }

    public function subCat($partsBrandCategoryId)
    {
        $this->partsBrandCategory   = PartsBrandCategory::query()
            ->select('id', 'name', 'description', 'parts_parent_brand_id', 'parts_brand_category_id')
            ->where('id', $partsBrandCategoryId)
            ->with(['partsBrandCategories' => function($query){
                $query->select('id', 'parts_parent_brand_id', 'parts_brand_category_id', 'name', 'image', 'status');
        }])->first();

        $hasProducts = 'false' ;

//        if (count($this->partsBrandCategory->partsBrandCategories) < 1)
//        {
//            $hasProducts = 'true' ;
////            $this->products = $this->partsBrandCategory->partsProducts;
//        }
//        return $hasProducts;
        return view('frontend.product.sub-cat', [
            'category'      => $this->partsBrandCategory,
            'subCategories' => count($this->partsBrandCategory->partsBrandCategories) > 0 ? $this->partsBrandCategory->partsBrandCategories : null,
//            'products'      => $this->products,
//            'hasProducts'      => $hasProducts,
            'is_nobanner'   => count($this->partsBrandCategory->partsBrandCategories) > 0 ? 0 : 1,
        ]);
    }

//    public function subSubCat($subCategoryId)
//    {
//        return view('frontend.product.sub-sub-cat', [
//            'subCategory'   => PartsBrandCategory::select('id', 'name')->find($subCategoryId),
//            'is_nobanner'   => 1,
//            'products'      => PartsProduct::where('status', 1)->select('id', 'title', 'main_image', 'parts_brand_category_id')->get(),
//        ]);
//    }

    public function productDetails($productId, $slug = null)
    {
//        $this->product          = PartsProduct::find($productId);
//        $this->relatedProducts  = PartsProduct::where(['parts_brand_category_id' => $this->product->parts_brand_category_id, 'status' => 1])->take(4)->get(['id', 'parts_brand_category_id', 'title', 'main_image']);
//        return view('frontend.product.product-details', [
//            'is_nobanner'       => 1,
//            'product'           => $this->product,
//            'relatedProducts'   => $this->relatedProducts
//        ]);
        $this->product      = PartsProduct::find($productId);
        $bikeBrandGroups    = $this->product->motorBikes->groupBy('bike_brand_id');
        foreach ($bikeBrandGroups as $key => $bikeBrandGroup)
        {
            $bikeBrandGroup[0]->custom_brand_name = BikeBrand::find($key)->name;
        }
        $this->relatedProducts  = PartsProduct::where(['parts_brand_category_id' => $this->product->parts_brand_category_id, 'status' => 1])->where('id', '!=', $productId)->take(4)->get(['id', 'parts_brand_category_id', 'title', 'main_image']);
        return view('frontend.product.product-details', [
            'is_nobanner'       => 1,
            'product'           => $this->product,
            'relatedProducts'   => $this->relatedProducts,
            'bikeBrandGroups'   => $bikeBrandGroups
        ]);
    }

    public static function changeSlugToName($text)
    {
        return str_replace('-', ' ', $text);
    }
    public function productSearch(Request $request)
    {
//        if (isset($request->brand_id))
//        {
//            $robiul = PartsParentBrand::find($request->brand_id);
////            $robiul->where('id', $request->brand_id)->first();
//            $robiul->partsBrandCategories->each->partsProducts->pluck('partsProducts')->flatten()/*->filter*/;
//        } else {
            $this->products = MotorBike::query()
                ->whereHas('partsProducts')
                ->where('status', 1);
            if (isset($request->motortype))
            {
                $motortype  = BikeMotorType::where('name', self::changeSlugToName($request->motortype))->first();
                if (!empty($motortype))
                {
                    $this->products = $this->products->where('bike_motor_type_id', $motortype->id);
                }
            }
            if (isset($request->brand))
            {
                $brand = BikeBrand::where('name', self::changeSlugToName($request->brand))->first();
                if (!empty($brand))
                {
                    $this->products = $this->products->where('bike_brand_id', $brand->id);
                }
            }
            if (isset($request->motor))
            {
                $motor = MotorBike::where('model_name', self::changeSlugToName($request->motor))->first();
                if (!empty($motor))
                {
                    $this->products = $this->products->where('id', $motor->id);
                }
            }
            if (isset($request->enginesize))
            {
                $enginesize = BikeEngineSize::where('name', self::changeSlugToName($request->enginesize))->first();
                if (!empty($enginesize))
                {
                    $this->products = $this->products->where('bike_engine_size_id', $enginesize->id);
                }
            }
            if (isset($request->year))
            {
                $year = BikeYearVersion::where('name', self::changeSlugToName($request->year))->first();
                if (!empty($year))
                {
                    $this->products = $this->products->where('bike_year_version_id', $year->id);
                }
            }

            $this->products = $this->products
//                ->whereHas('partsProducts' , function($query) use ($request) {
                ->with(['partsProducts' => function($query) use ($request) {
                    if (isset($request->category))
                    {
                        $category   = PartsBrandCategory::where('name', $request->category)->first();
                        if (!empty($category))
                        {
                            $query->where('parts_brand_category_id', $category->id);
                        }
                    }
                    if (isset($request->title))
                    {
                        $query->where('title', 'LIKE', "%".htmlspecialchars_decode($request->title)."%");
                    }
                    if (isset($request->brand_id))
                    {
//                        $query->whereHas('partsBrandCategory' , function($partsBrandCategory) use ($request) {
//                            $partsBrandCategory->where('parts_parent_brand_id', $request->brand_id);
//                        });
                        $query->with(['partsBrandCategory' => function($partsBrandCategory) use ($request) {
                            $partsBrandCategory->where('parts_parent_brand_id', $request->brand_id);
                        }]);
                    }
                    $query->where('status', 1)->select('id', 'title', 'main_image', 'parts_brand_category_id');
//                })
                }])
                ->latest()
                ->get()
                ->pluck('partsProducts')
                ->flatten()
                ->unique('id')
//                ->filter();
//                ->map(function ($item) {
//                    // Check if 'parts_brand_category' is not null
//                    if (!is_null(data_get($item, 'partsBrandCategory'))) {
//                        return $item;
//                    }
//                })
                ->filter(function ($item){
                    if ($item->partsBrandCategory != null)
                    {
                        return $item;
                    }
                })
                ->values()
                ->all();

//        }
//        return $this->products;
//        return count($this->products);
//return collect($this->products)->sortByDesc('id')->values()->all();
        return view('frontend.product.product-search', [
            'is_nobanner'          => 1,
            'bikeBrands'           => BikeBrand::where('status', 1)->get(['id', 'name']),
            'motorBikes'           => MotorBike::where('status', 1)->get(['id', 'model_name']),
            'motorTypes'           => BikeMotorType::where('status', 1)->get(['id', 'name']),
            'engineSizes'          => BikeEngineSize::where('status', 1)->get(['id', 'name']),
            'bikeYearVersions'     => BikeYearVersion::where('status', 1)->get(['id', 'name']),
            'partsCategories'      => PartsBrandCategory::where('status', 1)->whereHas('partsProducts')->get(['id', 'name']),
            'products'             => $this->products ?? [],
        ]);
    }

    public function bikeBrand(Request $request, $bike_motor_type_id)
    {
        $bikeBrands = MotorBike::query()
            ->where(['bike_motor_type_id' => $bike_motor_type_id, 'status' => 1])
            ->with(['bikeBrand' => function($query){
                $query->where('status', 1)->select('id', 'name', 'logo');
            }])
            ->get(['id', 'model_name', 'image', 'bike_brand_id'])
            ->pluck('bikeBrand')
            ->filter();
        return view('frontend.product.bike-brand', [
            'bikeBrands'    => $bikeBrands,
            'motorType'     => BikeMotorType::select('id', 'name')->find($bike_motor_type_id)
        ]);
    }


    public function bike(Request $request, $bike_brand_id, $brand_name)
    {
        return view('frontend.product.bike', [
            'bikeModels'    => MotorBike::where(['bike_brand_id' => $bike_brand_id, 'status' => 1])->latest()->get(['id', 'bike_brand_id', 'model_name', 'image']),
            'brand'         => BikeBrand::select('id', 'name')->find($bike_brand_id),
        ]);
    }
//    public function bike(Request $request, $bike_brand_id, $bike_motor_type_id)
//    {
//        $brand   = MotorBike::select('id', 'bike_brand_id', 'bike_motor_type_id')->find($bike_brand_id, $bike_motor_type_id);
////        $brand   = BikeBrand::select('id', 'name', 'logo')->find($bike_brand_id);
//        $bikes  = MotorBike::where(['status'=> 1, 'bike_brand_id' => $bike_brand_id])->select('id', 'bike_brand_id', 'model_name', 'image')->latest()->get();
//        return view('frontend.product.bike', [
//            'bikeModels' => $bikes,
//            'brand'  => $brand
//        ]);
//    }

}
