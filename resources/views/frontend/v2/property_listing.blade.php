@extends('frontend.v2.frontend')
@section('content')
      <nav id="nav">
            <ul class="main-navigation text-upparcase">
                <li class="active">
                    <a href="{{URL::to('/')}}"><span class="middle-align"><span class="icon-home"></span>HOME</span></a>
                </li>
                <li>
                    <a href="{{URL::to('/')}}/search"><span class="middle-align"><span class="icon-d-building"></span>Properties</span></a>
                </li>
                <li>
                    <a href="{{URL::to('agents')}}"><span class="middle-align"><span class="icon-male-close-up-silhouette-with-tie"></span>AGENTS</span></a>
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
                        <form class="filter-form">
                            <ul class="filters-links text-upparcase">
                                <li>
                                    <a href="#" class="opener">SEARCH FILTERS</a>
                                    <div class="slide"></div>
                                </li>
                                <li>
                                    <a href="#" class="opener">PROPERTY FOR</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <label for="buy-filter">
                                                    <input type="checkbox" id="buy-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">BUY</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="rent-filter">
                                                    <input type="checkbox" id="rent-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">BUY</span>
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
                                                <label for="house-filter">
                                                    <input type="checkbox" id="house-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">HOUSE</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="plot-filter">
                                                    <input type="checkbox" id="plot-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">PLOT</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="commercial-filter">
                                                    <input type="checkbox" id="commercial-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">COMMERCIAL</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">Property SUB-Type</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <label for="home-filter">
                                                    <input type="checkbox" id="home-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">HOUSE</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="pent-filter">
                                                    <input type="checkbox" id="pent-filter">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">penthouse</span>
                                                </label>
                                            </li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">LOCATION / SOCITY</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <select class="js-example-basic-single">
                                                    <option>1dasdasdsa</option>
                                                    <option>dasdasda1</option>
                                                    <option>dsadadsadad1</option>
                                                    <option>1dasdasdas</option>
                                                    <option>dsadasda1</option>
                                                    <option>1dsadasd</option>
                                                    <option>dsadasdasd1</option>
                                                </select>
                                            </li>
                                            <li>
                                                <select class="js-example-basic-single">
                                                    <option>dasdsadad1</option>
                                                    <option>dsadsadasd1</option>
                                                    <option>dasdadada1</option>
                                                    <option>dsadasdad1</option>
                                                    <option>dasdasdas1</option>
                                                    <option>dsadasd1</option>
                                                    <option>adsad1</option>
                                                </select>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="opener">LAND AREA</a>
                                    <div class="slide">
											<span class="fake-select">
												<select>
                                                    <option>1dasdasdsa</option>
                                                    <option>dasdasda1</option>
                                                    <option>dsadadsadad1</option>
                                                    <option>1dasdasdas</option>
                                                    <option>dsadasda1</option>
                                                    <option>1dsadasd</option>
                                                    <option>dsadasdasd1</option>
                                                </select>
											</span>
                                        <div class="fromTo">
                                            <div class="field-holder">
                                                <input type="number" placeholder="From">
                                            </div>
                                            <div class="field-holder">
                                                <input type="number" placeholder="To">
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
                                                <input type="number" placeholder="From">
                                            </div>
                                            <div class="field-holder">
                                                <input type="number" placeholder="To">
                                            </div>
                                            <button type="submit">Go</button>
                                        </div>
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
                                            <span class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>Verified</span>
                                        </div>
                                        <div class="links-right">
                                            <ul class="quick-links">
                                                <li><a href="#"><span class="icon-phone"></span></a></li>
                                                <li><a href="#"><span class="icon-empty-envelop"></span></a></li>
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
                </div>
            </div>
        </div>
    </main>
@endsection