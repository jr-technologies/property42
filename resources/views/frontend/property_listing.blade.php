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
        <div class="public-propertyListing">
            <div class="holder">
                <span class="searchResult-counter">Showing <b>1</b> to <b>20</b> of <b>24,303</b> properties</span>
                <ul class="sortBy">
                    <li>Sorty By</li>
                    <li>
                        <select>
                            <option>Default Order</option>
                            <option>Price low to high</option>
                            <option>Price high to low</option>
                            <option>Beds low to high</option>
                            <option>Bed high to low</option>
                            <option>Area low to high</option>
                            <option>Area high to low</option>
                            <option>Date new to old</option>
                            <option>Date old to new</option>
                            <option>Verified only</option>
                            <option>Hot only</option>
                            <option>With videos</option>
                            <option>With photos</option>
                        </select>
                    </li>
                </ul>
            </div>
            <section class="property-posts">
                @foreach($response['data']['properties'] as $property)
                    <article class="post">
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
                        <div class="img-holder"><a href="#"><img src="{{$image}}" width="600" height="450" alt="image description"></a></div>
                        <div class="caption">
                            <strong class="post-heading"><a href="#">{{ $property->land->area.' '.$property->land->unit->name .' '.$property->type->subType->name.'
                        '.$property->purpose->name.' in '.$property->location->block->name.' Block'.
                        ' '.$property->location->society->name}}</a><span
                                        class="price">Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</span><br/>{{'('.str_limit($property->title,25).')' }}
                            </strong>
                            <address>{{str_limit($property->description,150)}}.</address>
                            <ul class="property-details">
                                <li>4 Bedrooms</li>
                                <li>4 Baths</li>
                                <li>4 Rooms (total)</li>
                            </ul>
                            <div class="holder">
                                <ul class="quick-links">
                                    <li><a href="property?propertyId={{$property->id}}"><span class="icon-pencil"></span>More Details</a></li>
                                    <li><a href="tel:{{$property->phone}}">
                                            <span class="icon-phone_iphone"></span>
                                            <span class="hidden-xs">{{$property->phone}}</span>
                                            <span class="show-xs">Call now</span></a>
                                    </li>
                                    <li>
                                        <a href="mailto:&#102;&#097;&#108;&#097;&#110;&#097;&#064;&#100;&#104;&#097;&#109;&#107;&#097;&#110;&#097;&#046;&#099;&#111;&#109;">
                                            <span class="icon-envelope"></span>{{$property->email}}</a>
                                    </li>
                                </ul>
                                <div class="state-logo"><a href="#">
                                        <img
                                            @if($property->owner->agency->logo !=null)
                                            src="{{url('/')}}/temp/{{$property->owner->agency->logo}}"
                                            @else
                                            src="{{url('/')}}/assets/imgs/logo.png"
                                            @endif
                                            width="300" height="300" alt="zameen state">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
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