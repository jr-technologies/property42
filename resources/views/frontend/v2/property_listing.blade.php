@extends('frontend.v2.frontend')
@section('content')
      <nav id="nav">
            <ul class="main-navigation text-upparcase">
                <li class="active">
                    <a href="#"><span class="middle-align"><span class="icon-home"></span>HOME</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-d-building"></span>Properties</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-male-close-up-silhouette-with-tie"></span>AGENTS</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-street-map"></span>MAPS</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-light-bulb"></span>ABOUT</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-close-envelope"></span>CONTACT</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <main id="main" role="main">
        <div class="page-holder">
           <div class="listing-page">
                <div class="container">
                    <aside id="aside">
                        <form class="filter-form" id="properties-filter-form" method="get" action="<?= url('/search') ?>">
                            <ul class="filters-links text-upparcase">
                                <li>
                                    <a href="#" class="opener">PROPERTY FOR</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <label for="buy-filter" class="customRadio">
                                                    <input type="radio" name="purpose_id" id="buy-filter" class="filter-form-input" value="1" @if($response['data']['oldValues']['purposeId'] == 1) checked @endif>
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">BUY</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="rent-filter" class="customRadio">
                                                    <input type="radio" name="purpose_id" id="rent-filter" class="filter-form-input" value="2" @if($response['data']['oldValues']['purposeId'] == 2) checked @endif>
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">Rent</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">Property Type</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <label for="all-sub-types" class="customRadio">
                                                    <input type="radio" id="all-sub-types"
                                                           @if($response['data']['oldValues']['propertyTypeId'] == "") checked @endif
                                                           name="property_type_id" class="property_type filter-form-input" value="">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">All Types</span>
                                                </label>
                                            </li>
                                            @foreach($response['data']['propertyTypes'] as $propertyType)
                                                <li>
                                                    <label for="{{$propertyType->name."_".$propertyType->id}}" class="customRadio">
                                                        <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}"
                                                               @if($response['data']['oldValues']['propertyTypeId'] == $propertyType->id)checked @endif
                                                        name="property_type_id" class="property_type filter-form-input" value="{{$propertyType->id}}">
                                                        <span class="fake-checkbox"></span>
                                                        <span class="fake-label">{{$propertyType->name}}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">Property SUB-Type</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <label for="all-sub-types" class="customRadio">
                                                    <input type="radio" id="all-sub-types"
                                                           @if($response['data']['oldValues']['subTypeId'] == "") checked @endif
                                                           name="sub_type_id" class="property_sub_type filter-form-input" value="">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">All Sub Types</span>
                                                </label>
                                            </li>
                                            @foreach($response['data']['propertySubtypes'] as $propertySubType)
                                                <li>
                                                    <label for="{{$propertySubType->name."_".$propertySubType->id}}" class="customRadio">
                                                        <input type="radio" id="{{$propertySubType->name."_".$propertySubType->id}}"
                                                               @if($response['data']['oldValues']['subTypeId'] == $propertySubType->id) checked @endif
                                                               name="sub_type_id" class="property_sub_type filter-form-input" value="{{$propertySubType->id}}">
                                                        <span class="fake-checkbox"></span>
                                                        <span class="fake-label">{{$propertySubType->name}}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">LOCATION / SOCITY</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <select class="js-example-basic-single filter-form-input" name="society_id">
                                                    <option  value="">All Societies</option>
                                                    @foreach($response['data']['societies'] as $society)
                                                        <option value="{{$society->id}}" @if($response['data']['oldValues']['societyId'] == $society->id) selected @endif>{{$society->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li>
                                                <select class="js-example-basic-single filter-form-input  @if(sizeof($response['data']['blocks']) == 0) disabled @endif" name="block_id">
                                                    <option  value="">All Blocks</option>
                                                    @foreach($response['data']['blocks'] as $block)
                                                        <option value="{{$block->id}}" @if($response['data']['oldValues']['blockId'] == $block->id) selected @endif>{{$block->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">LAND AREA</a>
                                    <div class="slide">
											<span class="fake-select">
												<select name="land_unit_id" class="filter-form-input">
                                                    @foreach($response['data']['landUnits'] as $landUnit)
                                                        <option value="{{$landUnit->id}}" @if($response['data']['oldValues']['landUnitId'] == $landUnit->id) selected @elseif($response['data']['oldValues']['landUnitId'] == "" && $landUnit->id == 3) selected @endif>{{$landUnit->name}}</option>
                                                    @endforeach
                                                </select>
											</span>
                                        <div class="fromTo">
                                            <div class="field-holder">
                                                <input type="number" placeholder="From"  name="land_area_from" value="{{$response['data']['oldValues']['landAreaFrom']}}">
                                            </div>
                                            <div class="field-holder">
                                                <input type="number" placeholder="To" name="land_area_to" value="{{$response['data']['oldValues']['landAreaTo']}}">
                                            </div>
                                            <button type="submit">Go</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">PRICE RANGE</a>
                                    <div class="slide">
                                        <div class="fromTo">
                                            <div class="field-holder">
                                                <input type="number" placeholder="From" name="price_from" value="{{$response['data']['oldValues']['priceFrom']}}" class="priceInputFrom">
                                            </div>
                                            <div class="field-holder">
                                                <input type="number" placeholder="To"  name="price_to"value="{{$response['data']['oldValues']['priceTo']}}" class="priceInputTo">
                                            </div>
                                            <button type="submit">Go</button>
                                            <span class="calculatedPrice"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </aside>
                    <section id="content">
                        @foreach($response['data']['properties'] as $property)
                        <article class="publicProperty-post">
                            <?php
                            $image = url('/')."/assets/imgs/no.png";
                            foreach($property->documents as $document)
                            {
                                if($document->type == 'image' && $document->main == true)
                                {
                                    $image = url('/').'/temp/'.$document->path;
                                }
                            }
                            ?>
                            <div class="image-holder">
                                <img src="{{$image}}" alt="image description">
                                <a href="#" class="add-to-favorite"><span class="icon-Vector-Smart-Object31"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span></a>
                                <span class="premiumProperty text-upparcase">Premium</span>
                            </div>
                            <div class="caption">
                                <div class="layout">
                                    <div class="left-area">
                                        <h1>{{ ''.$property->land->area.' '.$property->land->unit->name .' '}}{{$property->type->subType->name.'
                        '.$property->purpose->name.' in '.$property->location->block->name.' Block'.
                        ' '.$property->location->society->name}}</h1>
                                        <p>{{'('.str_limit($property->title,25).')' }}</p>
                                    </div>
                                    <div class="right-area">
                                        <strong class="price"><span>Rs</span> {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</strong>
                                        <ul class="public-ui-features text-capital">
                                            @foreach($property->features as $feature)
                                                @foreach($feature as $featureSection)
                                                    @if($featureSection->priority ==1)
                                                        <li><span>{{$featureSection->name}}</span><strong>{{$featureSection->value}}</strong></li>
                                                    @endif
                                                @endforeach
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="links-left">
                                        <a href="property?propertyId={{$property->id}}" class="btn-default text-upparcase">VIEW DETAILS <span class="icon-Vector-Smart-Object"></span></a>
                                        <a href="#" class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>Trusted</a>
                                    </div>
                                    <div class="links-right">
                                        <ul class="quick-links">
                                            <li><a href="#"><span class="icon-phone-call"></span></a></li>
                                            <li><a href="#"><span class="icon-close-envelope"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                            @endforeach
                    </section>
                    <?php
                    $for_previous_link = $_GET;
                    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                    $convertPreviousToQueryString  = http_build_query($for_previous_link);
                    $previousResult = URL('/search').'?'.$convertPreviousToQueryString;
                    ?>
                    <?php
                    $totalPaginationValue = intval(ceil($response['data']['totalProperties'] / config('constants.Pagination')));
                    $for_next_link = $_GET;
                    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
                    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
                    $convertToQueryString  = http_build_query($for_next_link);
                    $nextResult = URL('/search').'?'.$convertToQueryString;
                    ?>
                    <ul class="pager">
                        @if($totalPaginationValue !=0)
                            <li><a href="{{$previousResult}}" class="previous"><span class="icon-chevron-thin-left"></span></a></li>
                        @endif
                        <?php
                        $paginationValue = intval(ceil($response['data']['totalProperties'] / config('constants.Pagination')));
                        $query_str_to_array = $_GET;
                        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
                        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
                        $query_str_to_array['page'] = $i;
                        $queryString  = http_build_query($query_str_to_array);
                        $result = URL('/search').'?'.$queryString;
                        ?>
                        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
                        <?php }?>
                        @if($totalPaginationValue !=0)
                            <li><a href="{{$nextResult}}" class="next"><span class="icon-chevron-thin-right"></span></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection