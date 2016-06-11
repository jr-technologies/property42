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
                <div class="propertyDetails-page">
                    <div class="layout">
                        <div class="propertyImage-slider">
                            <div class="mask">
                                <?php
                                $images = [];
                                foreach ($response['data']['property']->documents as $document) {
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
                                        {
                                        <div class="slide"><a href="images/bg-main1.jpeg" rel="lighbox"
                                                              class="lightbox"><img
                                                        src="{{$image}}"
                                                        alt="image description"></a>
                                        </div>
                                        }
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
                                        @foreach($images as $image){
                                        <div class="propertyImage-slide"><a href="#"><img
                                                        src="{{$image}}"
                                                        alt="image description"></a></div>
                                            }
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
                                    <img src="{{url('/')}}/web-apps/frontend/assets/images/state-logo.jpg" width="300"
                                         height="300" alt="image description">

                                    <div class="holder">
                                        <strong class="name">Zain Ali</strong>
                                        <span class="agency-name">Home Real Estate &amp; Builders</span>
                                        <a href="#" class="agency-profile">Agency Profile</a>
                                    </div>
                                </div>
                                <ul class="contact-links">
                                    <li><a href="#"><span class="icon-envelope"></span>Send Email</a></li>
                                    <li><a href="tel:03374887421"><span class="icon-phone_iphone"></span>03374887421</a>
                                    </li>
                                </ul>
                                <strong class="summary">Summary:</strong>
                                <dl>
                                    <dt>Property ID:</dt>
                                    <dd>3014011</dd>
                                    <dt>Type:</dt>
                                    <dd>House</dd>
                                    <dt>Bedrooms:</dt>
                                    <dd>6</dd>
                                    <dt>Bathrooms:</dt>
                                    <dd>7</dd>
                                    <dt>Area:</dt>
                                    <dd>550 Sq. Yd.</dd>
                                    <dt>Price:</dt>
                                    <dd>Rs 7.5 Crore</dd>
                                    <dt>Added:</dt>
                                    <dd>1 day ago</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <h1>overview</h1>

                    <div class="overviewText-holder height">
                        <div class="overviewText">
                            <p>A well designed 1 Kanal House is available for sale in Johar Town, Lahore. <br>The House
                                is equipped with all the necessary facilities and is ready for possession. All you need
                                to do is move in.<br> The House has 5 beds, d/d, T.V lounge, S/Q beautifully designed
                                and fairly spacious. The house is available for Rs 40,000,000/-,<br> House is sure to be
                                a profitable deal for any genuine client.<br> Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit.</p>

                            <p>A well designed 1 Kanal House is available for sale in Johar Town, Lahore. <br>The House
                                is equipped with all the necessary facilities and is ready for possession. All you need
                                to do is move in.<br> The House has 5 beds, d/d, T.V lounge, S/Q beautifully designed
                                and fairly spacious. The house is available for Rs 40,000,000/-,<br> House is sure to be
                                a profitable deal for any genuine client.<br> Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit. Feel free to contact us for further
                                details about the House and to arrange a visit.<br> Feel free to contact us for further
                                details about the House and to arrange a visit.</p>
                        </div>
                        <a class="btn-showMore">Show more</a>
                    </div>
                    <ul class="property-qucikLinks">
                        <li><a onclick="window.print()"><span class="icon-printer"></span>Print this Ad</a></li>
                        <li><a href="#"><span class="icon-envelope"></span> Email to friend</a></li>
                        <li><a href="#"><span class="icon-favourites-filled-star-symbol"></span> Add to favorites</a>
                        </li>
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