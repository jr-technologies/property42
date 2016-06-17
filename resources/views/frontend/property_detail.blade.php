@extends('frontend.frontend')
@section('content')
    <div id="content">
        <div class="left-content">
            <div class="company-logos-sliders">
                <div class="mask">
                    <div class="slideset">
                        <div class="slide">
                            <ul class="company-logo">
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent1.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent2.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent3.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent4.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent5.png"
                                                     alt="image description"></a></li>
                            </ul>
                        </div>
                        <div class="slide">
                            <ul class="company-logo">
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent6.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent7.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent8.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent9.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent10.png"
                                                     alt="image description"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-content">
            <div class="page-holder">
                @if (Session::has('message'))
                    <span class="alert-success"><span class="icon-checkmark"></span>{{ Session::get('message') }} !<a class="close icon-cross"></a></span>
                @endif
                <div class="propertyDetails-page">
                    <div class="layout">
                        <div class="propertyImage-slider">
                            <div class="mask">
                                <?php
                                $images = [];
                                foreach ($response['data']['property']->documents as $document)
                                {
                                    if ($document->type == 'image') {
                                        $images[] = url('/') . '/temp/' . $document->path;
                                    }
                                }
                                if (sizeof($images == 0)) {
                                    $images[] = url('/') . "/assets/imgs/no.png";
                                }
                                ?>
                                <div class="slideset">
                                    @foreach($images as $image)
                                        <div class="slide"><a href="images/bg-main1.jpeg" rel="lighbox"
                                                              class="lightbox"><img
                                                        src="{{$image}}"
                                                        alt="image description"></a>
                                        </div>
                                    @endforeach
                                </div>
                                <span id="propertyImageCurrentSlide" class="current-num"></span>
                            </div>
                            <a href="#" class="propertyImage-slider-btn-prev"><span
                                        class="icon-chevron-thin-left"></span></a>
                            <a href="#" class="propertyImage-slider-btn-next"><span
                                        class="icon-chevron-thin-right"></span></a>

                            <div class="propertyImage-pagination">
                                <div class="propertyImage-mask">
                                    <div class="propertyImage-slideset">
                                        @foreach($images as $image)
                                        <div class="propertyImage-slide"><a href="#"><img
                                                        src="{{$image}}"
                                                        alt="image description"></a></div>

                                        @endforeach
                                    </div>
                                    <span class="paginationCurrent-num-1"></span>
                                </div>
                                <a href="#" class="propertyImage-pagination-btn-prev-1"><span
                                            class="icon-chevron-thin-left"></span></a>
                                <a href="#" class="propertyImage-pagination-btn-next-1"><span
                                            class="icon-chevron-thin-right"></span></a>
                            </div>
                        </div>
                        <div class="propertyOwnerInfo">
                            <header>
                                <span class="icon-home-button"></span>
                                <span>Do you want to view this property?</span>
                            </header>
                            <div class="description">
                                <div class="layout">
                                    @if($response['data']['property']->owner->agency->logo !=null)
                                    <img src="{{url('/') . '/temp/' . $response['data']['property']->owner->agency->logo}}" width="300"
                                         height="300" alt="image description">
                                     @endif
                                    <div class="holder">
                                        <strong class="name">{{$response['data']['property']->contactPerson}}</strong>
                                        @if($response['data']['property']->owner->agency !=null)
                                            <span class="agency-name">{{$response['data']['property']->owner->agency->name}}</span>
                                            <a href="{{ URL::to('agent?agent_id='.$response['data']['property']->owner->agency->id) }}" class="agency-profile">Agency Profile</a>
                                        @endif
                                    </div>
                                </div>
                                <ul class="contact-links">
                                    <li class="popup-holder">
                                        <a class="popup-opener"><span class="icon-envelope"></span>Send Email</a>
                                        <div class="popup">
                                            {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'email-popup'))}}

                                                <strong class="form-heading">Send Email</strong>
                                                <div class="input-field">
                                                    <label for="from">From:</label>
                                                    <div class="input-holder"><input type="text" id="from" name="from" required></div>
                                                </div>
                                                <div class="input-field">
                                                    <label for="msg">Message:</label>
                                                    <div class="input-holder"><textarea id="msg" name="message" required></textarea></div>
                                                </div>
                                                <div class="input-field"><input type="submit" value="Send"></div>
                                            {{Form::close()}}
                                            <a class="popup-close"><span class="icon-cross"></span></a>
                                        </div>
                                    </li>
                                    <li><a href="tel:03374887421"><span class="icon-phone_iphone"></span>03374887421</a></li>
                                </ul>
                                <?php
                                $heightPriorityFeatures =[];
                                foreach($response['data']['property']->features as $section => $features)
                                {
                                    foreach($features as $feature){
                                        if($feature->priority > 0)
                                        {
                                            $heightPriorityFeatures[] = $feature;
                                        }
                                    }
                                }

                                ?>
                                <strong class="summary">Summary:</strong>
                                <dl>
                                    <dt>Property ID:</dt>
                                    <dd>{{$response['data']['property']->id}}</dd>
                                    <dt>Type:</dt>
                                    <dd>{{$response['data']['property']->type->parentType->name}}</dd>
                                    @foreach($heightPriorityFeatures as $heightPriorityFeature)
                                        <dt>{{$heightPriorityFeature->name}}:</dt>
                                        <dd>{{$heightPriorityFeature->value}}</dd>
                                    @endforeach
                                    <dt>Area:</dt>
                                    <dd>{{$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name}}</dd>
                                    <dt>Price:</dt>
                                    <dd>Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}</dd>
                                    <dt>Added:</dt>
                                    <dd>1 day ago</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <h1>overview</h1>

                    <div class="overviewText-holder height">
                        <div class="overviewText">
                            <p>{{$response['data']['property']->description}}.</p>
                        </div>
                        <a class="btn-showMore">Show more</a>
                    </div>
                    <div class="extraFeature-block">
                        <h1>Property Features</h1>
                        @foreach($response['data']['property']->features as $sectionName=>$features)
                        <h2>{{$sectionName}}</h2>

                        <ul class="feature-list">
                            @foreach($features as $feature)
                            <li>
                                <span>{{$feature->name}}</span>
                                @if($feature->htmlStructure->name =='checkbox')
                                    <span class="last-child">yes</span>
                                @else
                                    <span class="last-child">{{$feature->value}}</span>
                                @endif
                            </li>
                                @endforeach
                        </ul>

                      @endforeach
                    </div>
                    <ul class="property-qucikLinks">
                        <li><a onclick="window.print()"><span class="icon-printer"></span>Print this Ad</a></li>
                        <li class="popup-holder">
                            <a class="popup-opener"><span class="icon-envelope"></span>Email to friend</a>
                            <div class="popup">
                                {{Form::open(array('url'=>'property-to-friend','method'=>'POST','class'=>'email-popup'))}}
                                    <strong class="form-heading">Send Email</strong>
                                    <div class="input-field">
                                        <label for="from1">To:</label>
                                        <div class="input-holder"><input type="text" required name="to" required id="to"></div>
                                    </div>
                                    <div class="input-field">
                                        <label for="msg1">Message:</label>
                                        <div class="input-holder"><textarea id="msg" required name="message" required></textarea></div>
                                    </div>
                                    <div class="input-field"><input type="submit" value="Send"></div>
                               {{Form::close()}}
                                <a class="popup-close"><span class="icon-cross"></span></a>
                            </div>
                        </li>
                        <li class="add-to-favs" property_id="{{$response['data']['property']->id}}"><a href="#"><span class="icon-favourites-filled-star-symbol"></span> Add to favorites</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="right-content">
            <ul class="posters">
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster1.jpg" width="523"
                                     height="737" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster2.jpg" width="198"
                                     height="255" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster3.jpg" width="194"
                                     height="259" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster1.jpg" width="523"
                                     height="737" alt="image description"></a></li>
            </ul>
        </div>
    </div>
@endsection