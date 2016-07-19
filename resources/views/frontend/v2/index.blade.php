@extends('frontend.v2.frontend')
@section('content')
        <div class="main-visualSection">
            <div class="container">
                <strong class="main-heading text-upparcase"><span class="blue">LIST</span> <span class="black">yOUR</span> PROPERTY</strong>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                <ul class="number-of-properties text-upparcase">
                    <li>
                        <strong class="numberOfProperty">161</strong>
                        <span class="tag">SALeS</span>
                    </li>
                    <li>
                        <strong class="numberOfProperty">488</strong>
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
                                    <input type="radio" name="subType" id="all-type">
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
                                    <span class="label">Location / Socity</span>
                                    <div class="input-holder">
                                        <select name="society_id" id="society" class="js-example-basic-single">
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
        </div>
    </div>
    <main id="main" role="main">
        <section class="generic-section">
            <div class="container">
                <h1>News <span>Update</span></h1>
                <div class="news-sliderHolder">
                    <div class="news-carousel">
                        <div class="mask">
                            <div class="slideset">
                                <div class="slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/img01.jpg" width="495" height="363" alt="image description"></a></div>
                                <div class="slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/img01.jpg" width="495" height="363" alt="image description"></a></div>
                                <div class="slide"><a href="#"><img src="{{url('/')}}/web-apps/frontend/v2/images/img01.jpg" width="495" height="363" alt="image description"></a></div>
                            </div>
                        </div>
                        <div class="pagination"></div>
                        <a href="#" class="btn-prev"><span class="icon-left-arrow"></span></a>
                        <a href="#" class="btn-next"><span class="icon-right-arrow"></span></a>
                    </div>
                    <div class="news-slideshow">
                        <div class="mask">
                            <div class="slideset">
                                <div class="slide">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                                    <a href="#" class="btn-default text-upparcase">Learn More</a>
                                </div>
                                <div class="slide">
                                    <p>standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    <a href="#" class="btn-default text-upparcase">Learn More</a>
                                </div>
                                <div class="slide">
                                    <p>It has survived not only five , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    <a href="#" class="btn-default text-upparcase">Learn More</a>
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
                    <li>
                        <a href="{{url('/')}}/search?society_id=1">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img11.jpg" alt="DHA">
                            <div class="caption">
                                <strong class="heading">DHA</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=2">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img02.jpg" alt="Bahria Town">
                            <div class="caption">
                                <strong class="heading">Bahria Town</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li class="double-width">
                        <a href="{{url('/')}}/search?society_id=16">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img08.jpg" alt="PARAGON CITY">
                            <div class="caption">
                                <strong class="heading">Paragon City</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li class="double-width">
                        <a href="{{url('/')}}/search?society_id=290">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img05.jpg" alt="DHA city">
                            <div class="caption">
                                <strong class="heading">DHA city</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=114">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img06.jpg" alt="Grand Avenue">
                            <div class="caption">
                                <strong class="heading">Grand Avenue</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=290">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img07.jpg" alt="DHA city">
                            <div class="caption">
                                <strong class="heading">DHA city</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=232">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img04.jpg" alt="Al Jalil">
                            <div class="caption">
                                <strong class="heading">Al Jalil</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=38">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img10.jpg" alt="Centrel Park">
                            <div class="caption">
                                <strong class="heading">Centrel Park</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li class="double-width">
                        <a href="{{url('/')}}/search?society_id=14">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img09.jpg" alt="Pakarab">
                            <div class="caption">
                                <strong class="heading">Pakarab</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=1">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img11.jpg" alt="Al Makkah Land">
                            <div class="caption">
                                <strong class="heading">Al Makkah Land</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li class="double-width">
                        <a href="{{url('/')}}/search?society_id=80">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img12.jpg" alt="Al Makkah Land">
                            <div class="caption">
                                <strong class="heading">Lahore Moterway City</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}/search?society_id=1">
                            <img src="{{url('/')}}/web-apps/frontend/v2/images/img11.jpg" alt="Al Makkah Land">
                            <div class="caption">
                                <strong class="heading">Al Makkah Land</strong>
                                <ul class="numberOfproperties">
                                    <li><span>Commercial</span><span>88</span></li>
                                    <li><span>Home</span><span>88</span></li>
                                    <li><span>Land</span><span>88</span></li>
                                </ul>
                            </div>
                        </a>
                    </li>
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
                                          <li><a href="#"><img src="{{$image}}" alt="image description"></a></li>
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
                    PROPERTY42.PK is providing a complete property maintenance solution package that address user’s needs. Our approach is simple.  We provide professional, trustworthy property management services</p>
            </div>
        </section>
        <section class="generic-section questions">
            <div class="container text-center">
                <h1>Have any <span>Question?</span></h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
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