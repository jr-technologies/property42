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
                </div>
            </div>
        </div>
    </main>
@endsection