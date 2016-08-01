@extends('frontend.v2.frontend')
@section('content')
    <nav id="nav">
        <div class="nav-holder">
            <a href="#" class="navigation-toggler close"><span class="icon-cross"></span></a>
            <ul class="main-navigation text-upparcase">
                <li>
                    <a href="{{URL::to('/')}}"><span class="middle-align"><span class="icon-home"></span>HOME</span></a>
                </li>
                <li class="active">
                    <a href="{{URL::to('/')}}/search"><span class="middle-align"><span class="icon-d-building"></span>Properties</span></a>
                </li>
                <li>
                    <a href="{{URL::to('agents')}}"><span class="middle-align"><span
                                    class="icon-male-close-up-silhouette-with-tie"></span>AGENTS</span></a>
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
            <div class="mobile-content text-center hidden">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/property42pk-1562646287317094/"><span
                                    class="icon-facebook"></span></a></li>
                    {{--<li><a href="#"><span class="icon-google-plus-symbol"></span></a></li>--}}
                    {{--<li><a href="#"><span class="icon-linkedin"></span></a></li>--}}
                    <li><a href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
                </ul>
                <span class="copyright">Copyright, <a href="#">Property42.pk</a></span>
            </div>
        </div>
    </nav>
    </div>
    <main id="main" role="main">
        <div class="page-holder">
            <div class="agent-listing-page">
                <div class="container">
                    <a class="aside-opener-filters">More Filters <b>(Land Area / Price...)</b><span class="button"><b></b></span></a>
                    <aside id="aside" class="hideOnMobile">
                        {{ Form::open(array('url' => 'agents','method' => 'GET','class'=>'filter-form')) }}
                         <ul class="filters-links text-upparcase">
                               <li class="active">
                                    <a class="filters-links-opener">LOCATION / SOCITY</a>
                                    <div class="slide">
                                        <ul class="filterChecks">
                                            <li>
                                                <select  name="society" class="js-example-basic-single">
                                                    <option selected disabled>Search by society</option>
                                                    <option value="" @if($response['data']['params']['society'] == "") selected @endif>All Societies</option>
                                                    @foreach($response['data']['societies'] as $society)
                                                        <option value="{{$society->id}}" @if($response['data']['params']['society'] == $society->id) selected @endif>{{$society->name}}</option>
                                                    @endforeach
                                                </select>

                                            </li>
                                            <li>
                                                <select  name="agency_name" class="js-example-basic-single">
                                                    <option selected disabled>Search by Agents</option>
                                                    <option value="" @if($response['data']['params']['agencyName'] == "") selected @endif>All Agent</option>
                                                    @foreach($response['data']['allAgents'] as $agent)
                                                        <option value="{{$agent->agencies[0]->name}}" @if($response['data']['params']['agencyName'] == $agent->agencies[0]->name) selected @endif>{{$agent->agencies[0]->name}}</option>
                                                    @endforeach
                                                </select>

                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        <input type="submit" value="Search Agent">
                        {{Form::close()}}
                    </aside>
                    <section id="content">
                        <div class="propertyNotFound hidden">
                            <strong class="no-heading">sorry, no record found</strong>
                            <p>Maybe your search was to specific, please try searching with another term.</p>
                        </div>
                        <div class="artical-holder">
                            @foreach($response['data']['agents'] as $agent)
                                <?php
                                $image = url('/')."/assets/imgs/no.png";
                                foreach($agent->agencies as $agency)
                                {
                                    if($agency->logo !="")
                                    {
                                        $image = url('/').'/temp/'.$agency->logo;
                                    }
                                }
                                ?>
                            <article class="publicAgent-post">
                                <div class="post-holder">
                                    <div class="image-holder">
                                        <a href="{{ URL::to('agent?agent_id='.$agent->id) }}">
                                        <img src="{{$image}}" alt="image description">
                                            </a>
                                        {{--<a href="#" class="add-to-favorite added"></a>--}}
                                        {{--<span class="premiumProperty text-upparcase">Premium</span>--}}
                                    </div>
                                    <div class="caption text-left">
                                        <div class="layout">
                                            <h1>{{$agent->agencies[0]->name}}</h1>
                                            <p>{{str_limit($agent->agencies[0]->description,100)}}</p>
                                        </div>
                                        <div class="layout">
                                            @if($agent->trustedAgent ==1)
                                            <span class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>Trusted</span>
                                            @endif
                                                <ul class="star-rating">
                                                <li><a href="#" class="one-star"></a></li>
                                                <li><a href="#" class="two-stars"></a></li>
                                                <li><a href="#" class="three-stars"></a></li>
                                                <li><a href="#" class="four-stars"></a></li>
                                                <li><a href="#" class="five-stars"></a></li>
                                            </ul>
                                        </div>
                                        <div class="layout links-holder">
                                            <div class="links-left">
                                                <a href="{{ URL::to('agent?agent_id='.$agent->id) }}" class="btn-default text-upparcase">VIEW DETAILS <span class="icon-Vector-Smart-Object"></span></a>
                                            </div>
                                            <div class="links-right">
                                                <ul class="quick-links">
                                                    <li><a href="#callPopup" class="lightbox call-agent-btn" data-tel="{{$agent->mobile}}"><span class="icon-phone"></span></a></li>
                                                    <li><a href="#sendEmail-popup" class="lightbox"><span class="icon-empty-envelop"></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                        <ul class="pager">
                            <?php
                            $urlParams = $_GET;
                            $agentLimits = 0;
                            $actualPage = (isset($urlParams['page']))?$urlParams['page']:1;
                            (isset($urlParams['limit'])?$agentLimits = $urlParams['limit']:$agentLimits = config('constants.Pagination'));
                            $totalPages = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                            $pageValue = (isset($urlParams['page']))?$urlParams['page']:1;
                            ?>
                            <?php
                            $for_previous_link = $_GET;
                            $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                            ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                            $convertPreviousToQueryString  = http_build_query($for_previous_link);
                            $previousResult = URL('/agents').'?'.$convertPreviousToQueryString;
                            ?>
                            <?php
                            //This section manage the > button in pagination

                            ($pageValue == $totalPages)?$urlParams['page'] = $pageValue:$urlParams['page'] = $pageValue+1;
                            $convertToQueryString  = http_build_query($urlParams);
                            $nextResult = URL('/agents').'?'.$convertToQueryString;
                            ?>
                            <ul class="pager">
                                <?php
                                $urlParams['page']=1;
                                $convertFirstRecordToQueryString  = http_build_query($urlParams);
                                $firstResult = URL('/agents').'?'.$convertFirstRecordToQueryString;
                                ?>
                                @if($actualPage >=5)
                                    <a href="{{$firstResult}}">First</a>
                                @endif

                                <li><a href="{{$previousResult}}" class="previous"><span class="icon-left-arrow"></span></a></li>
                                <?php
                                //This is section of code print the pagination
                                $query_str_to_array = $_GET;
                                $agentLimits =0;
                                (isset($query_str_to_array['limit'])?$agentLimits = $query_str_to_array['limit']:$agentLimits = config('constants.Pagination'));
                                $paginationValue = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                                $current_page = (isset($query_str_to_array['page'])) ? $query_str_to_array['page'] : 1;
                                for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
                                $query_str_to_array['page'] = $i;
                                $queryString = http_build_query($query_str_to_array);
                                $result = URL('/agents') . '?' . $queryString;
                                ?>
                                <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
                                <?php }?>
                                @if($actualPage != $totalPages)
                                    <li><a href="{{$nextResult}}" class="next"><span class="icon-right-arrow"></span></a></li>
                                @endif
                                <?php

                                $for_last_link = $_GET;
                                $agentLimits =0;
                                (isset($query_str_to_array['limit'])?$agentLimits = $for_last_link['limit']:$agentLimits = config('constants.Pagination'));
                                $totalPaginationValue = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                                $current_page2 = (isset($for_last_link['page']))? $for_last_link['page']: $totalPaginationValue;
                                $for_last_link['page']=$totalPaginationValue;
                                $convertLastRecordToQueryString  = http_build_query($for_last_link);
                                $lastResult = URL('/agents').'?'.$convertLastRecordToQueryString;
                                ?>
                                @if($current_page2 <=$paginationValue-4)
                                    <a href="{{$lastResult}}">Last</a>
                                @endif</ul>
                    </section>
                    <div class="popup-holder">
                        <div id="callPopup" class="lightbox call-agent generic-lightbox">
                            <span class="lighbox-heading">Phone Number</span>
                            <p></p>
                            <span class="information"><span class="icon-info"></span>When you call, don't forget to mention that you found this ad on Property42.pk</span>
                        </div>
                        <div id="sendEmail-popup" class="lightbox generic-lightbox">
                            <span class="lighbox-heading">Send Email</span>
                            {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                            <div class="field-holder">
                                <label for="name">Name</label>

                                <div class="input-holder"><input type="text" id="name" name="name"></div>
                            </div>
                            <div class="field-holder">
                                <label for="email">Email</label>

                                <div class="input-holder"><input type="email" id="email" name="email"
                                                                 required></div>
                            </div>
                            <div class="field-holder">
                                <label for="phone">phone</label>

                                <div class="input-holder"><input type="tel" id="phone" name="phone"
                                                                 required></div>
                            </div>
                            <div class="field-holder">
                                <label for="subject">subject</label>

                                <div class="input-holder"><input type="text" id="subject" name="subject">
                                </div>
                            </div>
                            <div class="field-holder">
                                <label for="message">message</label>

                                <div class="input-holder"><textarea id="message" name="message"
                                                                    required></textarea></div>
                            </div>
                            <button type="submit">SEND</button>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection