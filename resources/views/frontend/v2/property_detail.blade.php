@extends('frontend.v2.frontend')
@section('content')
    <main id="main" role="main">
        <div class="page-holder">
            <div class="propertyDetail-page">
                <div class="container">
                    <div class="detail-holder">
                        <div class="frame">
                            <div class="property-picture-holder">
                                <h1><span> {{ ''.$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name .' '}}
                                        {{$response['data']['property']->type->subType->name.'
                                         '.$response['data']['property']->purpose->name.' in '.$response['data']['property']->location->block->name.' Block'.
                                        ' '.$response['data']['property']->location->society->name}}</span></h1>
                                <div class="propertyImage-slider carousal">
                                    <div class="mask">
                                        <?php
                                        use App\Libs\Helpers\AuthHelper;
                                        $images = [];
                                        foreach ($response['data']['property']->documents as $document)
                                        {
                                            if ($document->type == 'image')
                                            {
                                                $images[] = url('/') . '/temp/' . $document->path;
                                            }
                                        }
                                        if(sizeof($images) == 0)
                                        {
                                            $images[] = url('/') . "/assets/imgs/no.png";
                                        }
                                        ?>
                                            <div class="slideset">
                                                @foreach($images as $image)
                                                    <div class="slide">
                                                        <a href="{{$image}}" rel="lighbox" class="lightbox"><img src="{{$image}}"
                                                                                                                 alt="image description"></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <span id="propertyImageCurrentSlide" class="current-num"></span>
                                    </div>
                                    <a href="#" class="propertyImage-slider-btn-prev"><span class="icon-left-arrow"></span></a>
                                    <a href="#" class="propertyImage-slider-btn-next"><span class="icon-right-arrow"></span></a>
                                    <div class="propertyImage-pagination carousal">
                                        <div class="propertyImage-mask mask">
                                            <div class="propertyImage-slideset slideset">
                                                @foreach($images as $image)
                                                    <div class="propertyImage-slide slide"><a href="#"><img src="{{$image}}" alt="image description"></a></div>
                                                @endforeach
                                              </div>
                                            <span class="paginationCurrent-num-1"></span>
                                        </div>
                                        <a href="#" class="propertyImage-pagination-btn-prev-1"><span class="icon-left-arrow"></span></a>
                                        <a href="#" class="propertyImage-pagination-btn-next-1"><span class="icon-right-arrow"></span></a>
                                    </div>
                                </div>
                                <span class="views">View <span class="number">{{$response['data']['property']->totalViews}}</span></span>
                                <ul class="star-rating">
                                    <li><a href="#">star</a></li>
                                    <li><a href="#">star</a></li>
                                    <li><a href="#">star</a></li>
                                    <li><a href="#">star</a></li>
                                    <li><a href="#">star</a></li>
                                </ul>
                            </div>
                            <?php
                            $images = url('/') . "/assets/imgs/no.png";
                            if ($response['data']['property']->owner->agency != null)
                            {
                                if ($response['data']['property']->owner->agency->logo != null)
                                {
                                    $images = url('/') . '/temp/' . $response['data']['property']->owner->agency->logo;
                                }
                            }
                            ?>
                            <div class="info-blockProperty">
                                <strong class="price"><span>Rs</span>{{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}</strong>
                                @if ($response['data']['property']->owner->agency != null)
                                <div class="pictureHolder"><a href="#"><img src="{{$images}}" alt="image description"></a></div>
                                @endif
                                @if($response['data']['property']->owner->agency !=null)
                                    <span class="heading">{{$response['data']['property']->owner->agency->name}}</span>
                                @endif
                                <div class="layout">
                                    <div class="pull-left">
                                        @if(isset($response['data']['propertyOwner']->trustedAgent) && $response['data']['propertyOwner']->trustedAgent == 1)
                                        <span class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>Trusted</span>
                                        @endif
                                            <ul class="star-rating">
                                            <li><a href="#">star</a></li>
                                            <li><a href="#">star</a></li>
                                            <li><a href="#">star</a></li>
                                            <li><a href="#">star</a></li>
                                            <li><a href="#">star</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <ul class="quick-links">
                                            <li><a href="#callPopup" class="lightbox call-agent-btn" data-tel="03154379760"><span class="icon-phone"></span></a></li>
                                            <li><a href="#"><span class="icon-empty-envelop"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="small-heading">Summary</span>
                                <ul class="sumery-list">
                                    <li>
                                        <span class="tag">Property ID</span>
                                        <span class="quantity">{{$response['data']['property']->id}}</span>
                                    </li>

                                    <li>
                                        <span class="tag">Society</span>
                                        <span class="quantity">{{$response['data']['property']->location->society->name}}</span>
                                    </li>
                                    @if($response['data']['property']->location->block != null && $response['data']['property']->location->block->name != 'other')
                                        <li>
                                            <span class="tag">Block</span>
                                            <span class="quantity">{{$response['data']['property']->location->block->name}}</span>
                                        </li>
                                    @endif

                                    <li>
                                        <span class="tag">Type</span>
                                        <span class="quantity">{{$response['data']['property']->type->parentType->name}}</span>
                                    </li>
                                    <li>
                                        <span class="tag blue">Area</span>
                                        <span class="quantity blue">{{$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name}}</span>
                                    </li>
                                    <li>
                                        <span class="tag blue">Price</span>
                                        <span class="quantity blue">{{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}</span>
                                    </li>
                                </ul>
                                <div class="layout">
                                    <div class="pull-left">
                                        <span class="timeOfAddedProperty">Property Added
                                            <?php
                                            $startTimeStamp = strtotime(date("Y/m/d"));
                                            $myDate =substr($response['data']['property']->createdAt, 0, 10);
                                            $endTimeStamp = strtotime($myDate);
                                            $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                            $numberDays = $timeDiff/86400;  // 86400 seconds in one day
                                            // and you might want to convert to integer
                                            $numberDays = intval($numberDays);
                                            $days = "";
                                            if($numberDays == 0){$days = 'today';}elseif($numberDays == 1){ $days= 'day ago';}else{$days='days ago';};
                                            ?>
                                            <b>@if($numberDays !=0){{$numberDays}} @endif {{$days}}</b></span>

                                    </div>
                                    <div class="pull-right">
                                        <?php
                                        $heightPriorityFeatures = [];
                                        foreach ($response['data']['property']->features as $section => $features) {
                                            foreach($features as $feature) {
                                                if($feature->priority > 0) {
                                                    $heightPriorityFeatures[] = $feature;
                                                }
                                            }
                                        }
                                        ?>
                                        <ul class="public-ui-features text-capital">
                                            @foreach($heightPriorityFeatures as $heightPriorityFeature)
                                            <li>
                                                <span><b>{{$heightPriorityFeature->name}}</b></span>
                                                <strong>{{$heightPriorityFeature->value}}</strong>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overview-section">
                            <div class="layout">
                                <span class="small-heading">Property Overview</span>
                                <a href="#" class="btn-hollow"><span class="icon-printer"></span>PRINT DETAILS</a>
                            </div>
                            <p>{{$response['data']['property']->description}}</p>
                        </div>
                        <div class="extra-feature-section">
                            <div class="extra-feature-holder">
                                @if($response['data']['property']->features !=null)
                                    <span class="small-heading">Property Features</span>
                                @endif
                                <div class="feature">
                                    @foreach($response['data']['property']->features as $sectionName=>$features)
                                    <span class="small-heading">{{$sectionName}}</span>
                                    <ul class="feature-list">
                                        @foreach($features as $feature)
                                            <li>
                                                <span class="text-feature"><span class="icon-bed"></span>{{$feature->name}}</span>
                                                @if($feature->htmlStructure->name =='checkbox')
                                                    <span class="stataus">yes</span>
                                                @else
                                                    <span class="stataus">{{$feature->value}}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection