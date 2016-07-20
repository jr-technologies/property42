@extends('frontend.v2.frontend')
@section('content')
        <div class="main-visualSection">
            <div class="container">
                <strong class="main-heading text-upparcase"><span class="blue">LIST</span> <span class="black">yOUR</span> PROPERTY</strong>
                <p>Are you thinking of buying your first property, downsizing, or looking to upgrade to bigger and better? Where do you want to live? Let us help you find that ideal home!</p>
                <ul class="number-of-properties text-upparcase">
                    <li>
                        <strong class="numberOfProperty">{{$response['data']['saleAndRentCount'][0]->totalProperties}}</strong>
                        <span class="tag">SALeS</span>
                    </li>
                    <li>
                        <strong class="numberOfProperty">{{$response['data']['saleAndRentCount'][1]->totalProperties}}</strong>
                        <span class="tag">RENTALS</span>
                    </li>
                </ul>
                {{ Form::open(array('url' => 'search','method' => 'GET','class'=>'mainSearch-form' )) }}

                    <ul class="typeOfBuying text-upparcase">
                        <li>
                            <label for="buy1">
                                <input type="radio" name="purpose_id" value="1" id="buy1" checked >
                                <span class="fake-label">Buy</span>
                            </label>
                        </li>
                        <li>
                            <label for="rent1">
                                <input type="radio" name="purpose_id" id="rent1" value="2">
                                <span class="fake-label">Rent</span>
                            </label>
                        </li>
                    </ul>
                    <div class="form-holder">
                        <ul class="subTypes">
                            <li>
                                <label for="all-type" class="customRadio">
                                    <input type="radio" name="property_type_id" id="all-type" value="">
                                    <span class="fake-radio"></span>
                                    <span class="fake-label">All types</span>
                                </label>
                            </li>
                            @foreach($response['data']['propertyTypes'] as $propertyType)
                                <li>
                                    <label for="{{$propertyType->name."_".$propertyType->id}}" class="customRadio">
                                        <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}"
                                        name="property_type_id" class="property_type" value="{{$propertyType->id}}">
                                        <span class="fake-radio"></span>
                                        <span class="fake-label">{{$propertyType->name}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="layout">
                            <ul class="inputsHolder">
                                <li>
                                    <span class="label">Location / Society</span>
                                    <div class="input-holder">
                                        <select name="society_id" id="society" class="js-example-basic-single">
                                            <option value="">All Societies</option>
                                        @foreach($response['data']['societies'] as $society)
                                                <option value="{{$society->id}}">{{$society->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <button type="submit"><span class="icon-search"></span>search</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                {{Form::close()}}
                <nav id="nav" class="fixed-scroll-block">
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
        </div>
    </div>
    <main id="main" role="main">
      <section class="generic-section">
            <div class="container">
                <h1>News <span>Update</span></h1>
                <div class="news-sliderHolder">
                    <div class="news-slideshow">
                        <div class="mask">
                            <div class="slideset">
                                <div class="slide">
                                    <div class="layout">
                                        <div class="news-carousel">
                                            <div class="news-mask">
                                                <div class="news-slideset">
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n1.jpg" width="495" height="363" alt="image description"></a></div>
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n2.jpg" width="495" height="363" alt="image description"></a></div>
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n3.jpg" width="495" height="363" alt="image description"></a></div>
                                                </div>
                                            </div>
                                            <div class="news-pagination"></div>
                                            <a href="#" class="news-btn-prev"><span class="icon-left-arrow"></span></a>
                                            <a href="#" class="news-btn-next"><span class="icon-right-arrow"></span></a>
                                        </div>
                                        <div class="caption">
                                            <p>{{str_limit("Real Estate elected committee meet with Finance Minister Ishaq Dar today at Islamabad regarding recently imposed property evolution tax.
                                                Real estate agents and investors protested against the increase in taxes on Saturday, expecting that the government would take some decisions in their favor.",170)}}</p>
                                            <a href="#" class="btn-default text-upparcase">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="layout">
                                        <div class="news-carousel">
                                            <div class="news-mask">
                                                <div class="news-slideset">
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n1.jpg" width="495" height="363" alt="image description"></a></div>
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n2.jpg" width="495" height="363" alt="image description"></a></div>
                                                    <div class="news-slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/n3.jpg" width="495" height="363" alt="image description"></a></div>
                                                </div>
                                            </div>
                                            <div class="news-pagination"></div>
                                            <a href="#" class="news-btn-prev"><span class="icon-left-arrow"></span></a>
                                            <a href="#" class="news-btn-next"><span class="icon-right-arrow"></span></a>
                                        </div>
                                        <div class="caption">
                                            <p>{{str_limit("After the protest of real estate agents protest Prime Minister take an action and ask to finance minister to discuss the matter with real estate stakeholder.",170)}}</p>
                                            <a href="#" class="btn-default text-upparcase">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination hidden"></div>
                        <a href="#" class="btn-prev hidden">next</a>
                        <a href="#" class="btn-next hidden">ok</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="generic-section">
            <h1>Top <span>Socities</span></h1>
            <div class="topSocities-holder">
                <ul class="socities">
                    @foreach($response['data']['importantSocieties'] as $society)
                    <li @if($society->important == 1)class="double-width"@endif>
                        <a href="{{url('/')}}/search?society_id={{$society->id}}">
                            <img src="{{url('/')}}/{{$society->path}}" alt="PARAGON CITY">
                            <div class="caption">
                                <strong class="heading">{{$society->name}}</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>{{rand(0,100)}}</span></li>
                                    <li><span>Home</span><span>{{rand(0,130)}}</span></li>
                                    <li><span>Land</span><span>{{rand(0,120)}}</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="generic-section agents">
            <div class="layout">
                <div class="left-side">
                    <h1>Featured <span>Agents</span></h1>
                </div>
                <div class="agent-slider">
                    <div class="mask">
                        <div class="slideset">
                                @foreach(array_chunk($response['data']['agents'], 12) as $agents)
                                    <div class="slide">
                                     <ul class="agents-logo">
                                        <?php
                                            foreach($agents as $agent){
                                                $image = url('/') . "/assets/imgs/no.png";
                                                foreach ($agent->agencies as $agency)
                                                {
                                                    if ($agency->logo != "")
                                                    {
                                                        $image = url('/') . '/temp/' . $agency->logo;
                                                    }
                                                }
                                        ?>
                                          <li><a href="{{ URL::to('agent?agent_id='.$agent->id) }}"><img src="{{$image}}" alt="image description"></a></li>
                                        <?php }?>
                                    </ul>
                                </div>
                                @endforeach

                        </div>
                    </div>
                    <a href="#" class="btn-prev"><span class="icon-left-arrow"></span></a>
                    <a href="#" class="btn-next"><span class="icon-right-arrow"></span></a>
                </div>
            </div>
        </section>
        <section class="generic-section about-us">
            <div class="container text-center">
                <h1>About <span>Us</span></h1>
                <p>PROPERTY42.PK is friendly portal website. We are providing a maximum feature with minimum exercise, here you can find your desired property on single click.</p>
                <p>PROPERTY42.PK is providing flexible search for user which will provide potential clients with a better overall online experience.
                    With modern housing and societies services and a growing population, PROPERT42.PK is a unique regional center and offers plenty of lifestyle and investment opportunity.
                    PROPERTY42.PK is providing a complete property maintenance solution package that address user,s needs. Our approach is simple. We provide professional, trustworthy property management services</p>
            </div>
        </section>
        <section class="generic-section questions">
            <div class="container text-center">
                <h1>Have any <span>Question?</span></h1>
                <p>Please Let us know if you need some help, our team is always ready to help you!</p>
                {{ Form::open(array('url' => 'contact_us','method' => 'POST','class'=>'submit-query text-left')) }}

                    <div class="layout">
                        <div class="input-holder"><input type="text" name="name" placeholder="Your Name"></div>
                        <div class="input-holder"><input type="email" name="email" placeholder="Your Email" required></div>
                        <div class="input-holder"><input type="text" name="subject" placeholder="Subject"></div>
                    </div>
                    <div class="layout">
                        <div class="input-holder full-width"><textarea placeholder="Your Message" name="message" required></textarea></div>
                    </div>
                    <button type="submit"><span>Submit</span></button>
                {{Form::close()}}
            </div>
        </section>
    </main>
@endsection