@extends('frontend.master')

@section('body')
    <section class="content-landing detail">
        <div class="head-content">
            <div class="overlay-head-content"></div>
            <div class="result-product">
                <div class="wrapper">
                    <h4>Search</h4>
                    <span class="result">Showing 1-3 of 3 Results</span>
                </div>
            </div>
            <div class="filter-result">
                <div class="wrapper">
                    <div class="left-filter">
                        <div class="box">
                            <span>Filter By</span>
                        </div>
                        <div class="select-filter">
                            <div class="list-select-filter" data-filter="brand" data-value="" data-placeholder="Brand">
                                <span class="btn-filter " id="brandLabel">
                                      Brand
                                </span>
                                <div class="drop-filter">
                                    <div class="in-drop-filter">
                                        <h5>Brand</h5>
                                        <div class="filter-list brand-select-tag">
                                            @if(!empty($bikeBrands))
                                                @foreach($bikeBrands as $index => $bikeBrand)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $bikeBrand->name) }}" @if(isset($_GET['brand'])) @if($_GET['brand'] == $bikeBrand->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $bikeBrand->name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-select-filter" data-filter="motortype" data-value="" data-placeholder="Motor Type">
                                  <span class="btn-filter " id="motortypeLabel">
                                          Motor Type
                                  </span>
                                <div class="drop-filter">
                                    <div class="in-drop-filter ">
                                        <h5>Motor Type</h5>
                                        <div class="filter-list motortype-select-tag">
                                            @if(!empty($motorTypes))
                                                @foreach($motorTypes as $motorType)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $motorType->name) }}" @if(isset($_GET['motortype'])) @if($_GET['motortype'] == $motorType->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $motorType->name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-select-filter" data-filter="motor" data-value="" data-placeholder="motorcycle">
                                  <span class="btn-filter " id="motorLabel">
                                      motorcycle
                                  </span>
                                <div class="drop-filter ">
                                    <div class="in-drop-filter">
                                        <h5>Motorcycle</h5>
                                        <div class="filter-list motor-select-tag">
                                            @if(!empty($motorBikes))
                                                @foreach($motorBikes as $motorBike)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $motorBike->model_name) }}" @if(isset($_GET['motor'])) @if($_GET['motor'] == $motorBike->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $motorBike->model_name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-select-filter" data-filter="enginesize" data-value="" data-placeholder="Engine Size">
                                  <span class="btn-filter " id="enginesizeLabel">
                                      Engine Size
                                  </span>
                                <div class="drop-filter">
                                    <div class="in-drop-filter">
                                        <h5>Engine Size</h5>
                                        <div class="filter-list enginesize-select-tag">
                                            @if(!empty($engineSizes))
                                                @foreach($engineSizes as $engineSize)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $engineSize->name) }}"  @if(isset($_GET['enginesize'])) @if($_GET['enginesize'] == $engineSize->id) class="selected" @endif @endif  @if(isset($_GET['brand'])) @if($_GET['brand'] == $bikeBrand->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $engineSize->name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-select-filter" data-filter="year" data-value="" data-placeholder="Year">
                                  <span class="btn-filter " id="yearLabel">
                                      Year
                                  </span>
                                <div class="drop-filter">
                                    <div class="in-drop-filter">
                                        <h5>Year</h5>
                                        <div class="filter-list year-select-tag">
                                            @if(!empty($bikeYearVersions))
                                                @foreach($bikeYearVersions as $bikeYearVersion)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $bikeYearVersion->name) }}"  @if(isset($_GET['year'])) @if($_GET['year'] == $bikeYearVersion->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $bikeYearVersion->name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-select-filter" data-filter="category" data-value="" data-placeholder="Category">
                                  <span class="btn-filter " id="categoryLabel">
                                      Category
                                  </span>
                                <div class="drop-filter">
                                    <div class="in-drop-filter">
                                        <h5>Engine Size</h5>
                                        <div class="filter-list category-select-tag">
                                            @if(!empty($partsCategories))
                                                @foreach($partsCategories as $partsCategory)
                                                    <a href="#" data-value="{{ str_replace(' ', '-', $partsCategory->name) }}" @if(isset($_GET['category'])) @if($_GET['category'] == $partsCategory->id) class="selected" @endif @endif >
                                                        <span class="tx">{{ $partsCategory->name }}</span>
                                                        <span class="x-tx"></span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-filter">
                        <span class="close-filter">Close</span>
                        <span class="reset-filter">Reset Filter</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="listing-wrap product">
                @if(count($products) > 0)
                    @forelse($products as $product)
                        <a href="{{ route('frontend.product-details', ['id' => $product->id, 'slug' => str_replace(' ', '-', $product->title)]) }}" class="list">
                            <figure>
                                <img src="{{ asset(!empty($product->main_image) ? $product->main_image : 'admin/no-img/no-image.png') }}" alt="" style="height: 245px">
                            </figure>
                            <span class="name-sparepart">{{ $product->partsBrandCategory->name ?? '' }}</span>
                            <h5 class="text-uppercase">{{ $product->title ?? '' }}</h5>
                        </a>
                    @empty
                        <p class="text-center">No Parts found</p>
                    @endforelse
                @endif
            </div>


        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.select-filter .btn-filter').on('click',function(){
                $('.select-filter .drop-filter').hide();
                $(this).next('.drop-filter').show();
                $('.head-content').addClass('overlay');
                $('.right-filter').addClass('close');
                $(this).addClass('active');
            });

            $('.filter-list a').on('click',function(e){
                e.preventDefault();
                var action = 'add';
                var th = $(this),
                    list = th.parents('.list-select-filter');
                if(th.hasClass('selected')){
                    var placeholder = list.attr('data-placeholder');
                    list.attr('data-value','');
                    list.find('.btn-filter').text(placeholder);
                    list.find('.btn-filter').removeClass('selected');

                    th.removeClass('selected');
                    action = 'remove';
                }else{
                    var text = th.find('.tx').text(),
                        val = th.attr('data-value');
                    list.attr('data-value',val);
                    list.find('.btn-filter').text(text);
                    list.find('.btn-filter').addClass('selected');

                    th.prevAll().removeClass('selected');
                    th.nextAll().removeClass('selected');
                    th.addClass('selected');
                    action = 'add';
                }

                closeFilter();
                var queryString = updateQueryStringParameter(window.location.toString(),th.parents('.list-select-filter').attr('data-filter'),th.attr('data-value'),action)

                window.location.href = queryString;

            });

            function updateQueryStringParameter(uri, key, value,action) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    if (action == 'add'){
                        return uri.replace(re, '$1' + key + "=" + value + '$2');
                    }else{
                        var splitURI = uri.split("?")[1].split("&");
                        keyVal = key + "=" + value;
                        if (keyVal == splitURI[0])
                        {
                            if (splitURI.length == 1)
                            {
                                return uri.replace(re,'');
                            }
                            return uri.replace(re,'?');
                        }else if (keyVal == splitURI[splitURI.length-1]){
                            return uri.replace(re,'');

                        }else{
                            return uri.replace(re,'&');
                        }
                    }
                }else {
                    return uri + separator + key + "=" + value;
                }
            }

            $('.reset-filter').on('click',function(){
                var list = $('.select-filter .list-select-filter');
                list.each(function(){
                    var th = $(this);
                    th.attr('data-value','');
                    th.find('.btn-filter').text(th.attr('data-placeholder'));
                    th.find('.btn-filter').removeClass('selected');
                    th.find('.filter-list a').removeClass('selected');
                });

                // window.location.href = "https://faito.co.id/en/search";
                window.location.href = "{{ route('frontend.product-search') }}";
            });
            $('.close-filter,.overlay-head-content').on('click',function(){
                closeFilter();
            });

            if($(window).width() <= 960){
                $('.filter-result .left-filter .box').on('click',function(){
                    if($(this).hasClass('active')){
                        $('.select-filter').fadeOut(300);
                        $('.head-content').removeClass('overlay');
                        $('.right-filter').removeClass('close');
                        $(this).parents('.filter-result').removeClass('active');
                    }else{
                        $('.select-filter').fadeIn(300);
                        $('.head-content').addClass('overlay');
                        $('.right-filter').addClass('close');
                        $(this).parents('.filter-result').addClass('active');
                    }
                });
            }
        })

        function closeFilter(){
            $('.head-content').removeClass('overlay');
            $('.select-filter .drop-filter').hide();
            $('.right-filter').removeClass('close');
            if($(window).width() <= 960){
                $('.select-filter').fadeOut(300);
                $('.filter-result').removeClass('active');
            }
        }
    </script>
    <script>
        $(function () {
            @if(isset($_GET['brand']))
                setSelectLevel('.brand-select-tag', '#brandLabel', "{{ $_GET['brand'] }}");
            @endif
            @if(isset($_GET['motortype']))
                setSelectLevel('.motortype-select-tag', '#motortypeLabel', "{{ $_GET['motortype'] }}");
            @endif
            @if(isset($_GET['motor']))
                setSelectLevel('.motor-select-tag', '#motorLabel', "{{ $_GET['motor'] }}");
            @endif
            @if(isset($_GET['enginesize']))
                setSelectLevel('.enginesize-select-tag', '#enginesizeLabel', "{{ $_GET['enginesize'] }}");
            @endif
            @if(isset($_GET['year']))
                setSelectLevel('.year-select-tag', '#yearLabel', "{{ $_GET['year'] }}");
            @endif
            @if(isset($_GET['category']))
                setSelectLevel('.category-select-tag', '#categoryLabel', "{{ $_GET['category'] }}");
            @endif
        })

        function setSelectLevel(selectTagSelector, levelSelector, placeholderValue = null) {
            // var text = $(selectTagSelector).find('.selected').text();
            // $(levelSelector).text(text).css("font-weight", "bolder");
            $(levelSelector).text(placeholderValue).css("font-weight", "bolder");
            $.each($(selectTagSelector+' a'), function (key, anchor) {
                var anchorElement = $(anchor).attr('data-value');
                if (anchorElement == placeholderValue)
                {
                    $(this).addClass('selected');
                }
            })
        }
    </script>
@endpush
