<div class="popup-search" id="popupsearch">
    <div class="close-popup-search">
        <span></span><span></span>
    </div>
    <div class="box-inner-search normal-search active">
        <form action="{{ route('frontend.product-search') }}">
            <input type="text" name="title" placeholder="Search Our Product">
            <a class="link-yellow btn-adv-search">Advance Search</a>
        </form>
    </div>
    <div class="box-inner-search advance-search">
        <h3>Advance Search</h3>
        <div class="form">
            <form action="{{ route('frontend.product-search') }}">
                <div class="row">
                    <div class="col half">
                        <div class="row">
                            <div class="col half">
                                <select name="brand" id="brand">
                                    <option value="">Brand</option>
                                    @if(!empty($bikeBrands))
                                        @foreach($bikeBrands as $bikeBrand)
                                            <option value="{{ $bikeBrand->id }}">{{ $bikeBrand->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col half">
                                <select name="motortype" id="motortype">
                                    <option value="">Motor Type</option>
                                    @if(!empty($motorTypes))
                                        @foreach($motorTypes as $motorType)
                                            <option value="{{ $motorType->id }}">{{ $motorType->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col half">
                        <div class="row">
                            <div class="col half">
                                <select name="enginesize" id="enginesize">
                                    <option value="">Engine Size</option>
                                    @if(!empty($engineSizes))
                                        @foreach($engineSizes as $engineSize)
                                            <option value="{{ $engineSize->id }}">{{ $engineSize->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col half">
                                <select name="year" id="year">
                                    <option value="">Year</option>
                                    @if(!empty($bikeYearVersions))
                                        @foreach($bikeYearVersions as $bikeYearVersion)
                                            <option value="{{ $bikeYearVersion->id }}">{{ $bikeYearVersion->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col half">
                        <select name="motor" id="motor">
                            <option value="">Motorcycle</option>
                            @if(!empty($motorBikes))
                                @foreach($motorBikes as $motorBike)
                                    <option value="{{ $motorBike->id }}">{{ $motorBike->model_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col half">
                        <select name="category" id="category">
                            <option value="">Category</option>
                            @if(!empty($partsCategories))
                                @foreach($partsCategories as $partsCategory)
                                    <option value="{{ $partsCategory->id }}">{{ $partsCategory->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br><br>
                        <input type="submit" value="Search Now" class="btn-yellow">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
