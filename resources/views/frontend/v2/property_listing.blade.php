@extends('frontend.v2.frontend')
@section('content')
    <div class="page-holder">
        <div class="listing-page">
            <div class="container">
                <a class="aside-opener-filters">Search Filters<span class="button"><b></b></span></a>
                <aside id="aside" class="hideOnMobile">
                    <form class="filter-form" id="properties-filter-form" method="get" action="<?= url('/search') ?>">
                        <ul class="filters-links text-upparcase">
                            <li class="active">
                                <a class="filters-links-opener">LAND AREA</a>
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
                            <li class="active">
                                <a class="filters-links-opener">PRICE RANGE</a>
                                <div class="slide">
                                    <div class="fromTo">
                                        <div class="field-holder">
                                            <input type="number" placeholder="From" name="price_from" value="{{$response['data']['oldValues']['priceFrom']}}" class="priceInputFrom PriceField">
                                        </div>
                                        <div class="field-holder">
                                            <input type="number" placeholder="To"  name="price_to"value="{{$response['data']['oldValues']['priceTo']}}" class="priceInputTo PriceField">
                                        </div>
                                        <button type="submit">Go</button>
                                    </div>
                                    <span class="calculatedPrice">Please enter the price.</span>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">PROPERTY FOR</a>
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
                            <li class="active">
                                <a class="filters-links-opener">Property Type</a>
                                <div class="slide">
                                    <ul class="filterChecks">
                                        <li>
                                            <label for="all-types" class="customRadio">
                                                <input type="radio" id="all-types"
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
                            <li class="active">
                                <a class="filters-links-opener">Property SUB-Type</a>
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
                            <li class="active">
                                <a class="filters-links-opener">LOCATION / SOCITY</a>
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
                                            <select class="js-example-basic-single filter-form-input " @if(sizeof($response['data']['blocks']) == 0) disabled @endif name="block_id">
                                                <option  value="">All Blocks</option>
                                                @foreach($response['data']['blocks'] as $block)
                                                    <option value="{{$block->id}}" @if($response['data']['oldValues']['blockId'] == $block->id) selected @endif>{{$block->name}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </form>
                </aside>
                <section id="content">
                    @foreach($response['data']['properties'] as $property)
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
                        <article class="publicProperty-post">
                            <div class="image-holder">
                                <a href="property?propertyId={{$property->id}}"><img src="{{$image}}" alt="image description"></a>
                                <a href="#" class="add-to-favorite"></a>
                                <span class="premiumProperty text-upparcase">@if($property->isFeatured !=null){{'Featured'}}@endif</span>
                            </div>
                            <div class="caption text-left">
                                <div class="layout">
                                    <div class="left-area">
                                        <h1><a href="property?propertyId={{$property->id}}">{{ ''.$property->land->area.' '.$property->land->unit->name .' '}}{{$property->type->subType->name.'
                                             '.$property->purpose->name.' in '.$property->location->block->name.' Block'.
                                             ' '.$property->location->society->name}}</a></h1>
                                        <p>{{str_limit($property->description,170) }}</p>
                                    </div>
                                    <div class="right-area">
                                        <strong class="price"><span>Rs</span> {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</strong>
                                        <ul class="public-ui-features text-capital">
                                            @foreach($property->features as $feature)
                                                @foreach($feature as $featureSection)
                                                    @if($featureSection->priority ==1)
                                                        <li>
                                                            <span><b>{{$featureSection->name}}</b><span {{($featureSection->name == 'bedrooms')?'class="icon-bed':'class="icon-bath'}}></span></span>
                                                            <strong>{{$featureSection->value}}</strong>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="links-left">
                                        <a href="property?propertyId={{$property->id}}" class="btn-default text-upparcase">VIEW DETAILS <span class="icon-Vector-Smart-Object"></span></a>
                                        @if(isset($property->isVerified) && $property->isVerified == 1)
                                            <span class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>Verified</span>
                                        @endif
                                    </div>
                                    <div class="links-right">
                                        <ul class="quick-links">
                                            <li><a href="#callPopup" class="lightbox call-agent-btn" data-tel="{{$property->phone}}"><span class="icon-phone"></span></a></li>
                                            <li><a href="#sendEmail-popup" class="lightbox"><span class="icon-empty-envelop"></span></a></li>
                                        </ul>
                                        <?php
                                        $image = url('/') . "/assets/imgs/no.png";
                                        if ($property->owner->agency != null) {
                                            if ($property->owner->agency->logo != null) {
                                                $image = url('/') . '/temp/' . $property->owner->agency->logo;
                                            }
                                        }
                                        ?>
                                        <a href="{{ URL::to('agent?agent_id='.$property->owner->id) }}"> <img src="{{$image}}" alt="image description" class="company-logo"></a>
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
                <div class="popup-holder">
                    <div id="callPopup" class="lightbox call-agent">
                        <p></p>
                    </div>
                    <div id="sendEmail-popup" class="lightbox">
                        <form class="inquiry-email-form">
                            <div class="field-holder">
                                <label for="name">Name</label>
                                <div class="input-holder"><input type="text" id="name"></div>
                            </div>
                            <div class="field-holder">
                                <label for="email">Email</label>
                                <div class="input-holder"><input type="email" id="email"></div>
                            </div>
                            <div class="field-holder">
                                <label for="phone">phone</label>
                                <div class="input-holder"><input type="tel" id="phone"></div>
                            </div>
                            <div class="field-holder">
                                <label for="subject">subject</label>
                                <div class="input-holder"><input type="text" id="subject"></div>
                            </div>
                            <div class="field-holder">
                                <label for="message">message</label>
                                <div class="input-holder"><textarea id="message"></textarea></div>
                            </div>
                            <button type="submit">SEND</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection