<?php

namespace App\Providers;

use App\Models\Backend\AdditionalFeatures\SiteSetting;
use App\Models\Backend\BikeManagement\BikeBrand;
use App\Models\Backend\BikeManagement\BikeEngineSize;
use App\Models\Backend\BikeManagement\BikeMotorType;
use App\Models\Backend\BikeManagement\BikeYearVersion;
use App\Models\Backend\BikeManagement\MotorBike;
use App\Models\Backend\PartsManagement\PartsBrandCategory;
use App\Models\Backend\PartsManagement\PartsParentBrand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('frontend.includes.footer', function ($view) {
            $view->with([
                'siteSettings'  => SiteSetting::all(),
            ]);
        });

        View::composer('frontend.includes.header', function ($view) {
            $view->with([
                'partsParentBrands'     => PartsParentBrand::where('status', 1)->select('id', 'name', 'logo')->get(),
                'siteSettings'          => SiteSetting::all(),
                'bikeBrands'           => BikeBrand::where('status', 1)->get(['id', 'name']),
                'motorBikes'           => MotorBike::where('status', 1)->get(['id', 'model_name']),
                'motorTypes'           => BikeMotorType::where('status', 1)->get(['id', 'name']),
                'engineSizes'          => BikeEngineSize::where('status', 1)->get(['id', 'name']),
                'bikeYearVersions'     => BikeYearVersion::where('status', 1)->get(['id', 'name']),
                'partsCategories'      => PartsBrandCategory::where('status', 1)->whereHas('partsProducts')->get(['id', 'name']),
            ]);
        });
    }
}
