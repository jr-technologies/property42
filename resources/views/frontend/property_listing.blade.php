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
            <a href="#SearchPublic-Property" class="mySearch lightbox">Search My Property<span class="icon-search"></span></a>

            <div class="holder">
                <span class="searchResult-counter">Showing <b>1</b> to <b>{{config('constants.Pagination') }}</b> of <b>{{$response['data']['totalProperties']}}</b> properties</span>
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
                                        class="price">Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</span>
                                <span class="subTitle">{{'('.str_limit($property->title,25).')' }}</span>
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
            <ul class="pager">
                <li><a href="#" class="previous"><span class="icon-chevron-thin-left"></span></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">8</a></li>
                <li><a href="#">9</a></li>
                <li><a href="#">10</a></li>
                <li><a href="#" class="next"><span class="icon-chevron-thin-right"></span></a></li>
            </ul>

            <div class="lightbox" id="SearchPublic-Property">
                <div class="mySearch-Form">
                    {{ Form::open(array('url' => 'search','method' => 'GET')) }}
                        <ul class="propertyPurpose">
                            <li>
                                <label for="buy-1">
                                    <input type="radio" name="purpose_id" value="1" id="buy1" checked>
                                    <span class="fake-label">Buy</span>
                                </label>
                            </li>
                            <li>
                                <label for="rent-1">
                                    <input type="radio" name="purpose_id" id="rent1" value="2">
                                    <span class="fake-label">Rent</span>
                                </label>
                            </li>
                        </ul>
                        <ul class="propertyType">
                            <li>
                                <label for="allTypes">
                                    <input type="radio" id="allTypes" name="property_type_id" checked>
                                    <span class="fake-label">All Types</span>
                                </label>
                            </li>

                            @foreach($response['data']['propertyTypes'] as $propertyType)
                            <li>
                                <label for={{$propertyType->name.$propertyType->id}}>
                                    <input type="radio" id={{$propertyType->name.$propertyType->id}}
                                            class="property_type"  name="property_type_id" value="{{$propertyType->id}}"
                                           @if($response['data']['oldValues']['purposeId'] == $propertyType->id)checked @endif>
                                    <span class="fake-label">{{$propertyType->name}}</span>
                                </label>
                            </li>
                                @endforeach
                        </ul>
                        <ul class="fields">
                            <li>
                                <label>Select Sub Type:</label>
                                <select name="sub_type_id" id="property_sub_types">
                                    <option disabled selected value>Property SubType</option>
                                    <option  value="">All Property SubType</option>
                                    @foreach($response['data']['propertySubtypes'] as $propertySubType)
                                        <option value="{{$propertySubType->id}}" @if($response['data']['oldValues']['purposeId'] ==$propertySubType->id)selected @endif>{{$propertySubType->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <label>Select Society:</label>
                                <select name="society_id" id="society">
                                    <option disabled selected value>Society</option>
                                    <option  value="">All Societies</option>
                                    @foreach($response['data']['societies'] as $society)
                                        <option value="{{$society->id}}">{{$society->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <label>Select Block:</label>
                                 <span class="load">
                                <select name="block_id" id="blocks">
                                    <option disabled selected value>Block</option>
                                </select>
                                 </span>
                            </li>
                            <li>
                                <label>Select Bedrooms:</label>
                                <select name="property_features[28]">
                                    <option disabled selected value>Bedrooms</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                    <option value=6>6</option>
                                    <option value=7>7</option>
                                    <option value=8>8</option>
                                    <option value=9>9</option>
                                    <option value=10>10</option>


                                </select>
                            </li>
                            <li>
                                <label>Price Range (Rs):</label>
                                <div class="input-holder"><input type="number" placeholder="From" name="price_from"></div>
                                <div class="input-holder"><input type="number" placeholder="To" name="price_to"></div>
                            </li>
                            <li>
                                <label>Land Area:</label>
                                <div class="input-holder"><input type="number" placeholder="From" name="land_area_from"></div>
                                <div class="input-holder"><input type="number" placeholder="To" name="land_area_to"></div>
                            </li>
                        </ul>
                        <button type="submit"><span class="icon-search"></span>Search my property</button>
                   {{Form::close()}}
                </div>
            </div>
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
  <script>
      function propertyTypeChangedInSearchPopup()
      {
          var property_type_id = $('.property_type').val();
          if(property_type_id !="") {
              //$('#property_sub_types').closest('.fake-select').addClass('loading');
              $.ajax({
                  url: apiPath.concat("types/subtypes"),
                  data: {
                      type_id: property_type_id
                  },
                  success: function (response) {
                      $('#property_sub_types').empty();
                      $('#property_sub_types').append($('<option>').text('select a SubType').attr('value', ''));
                      $.each(response.data.propertySubType, function (i, propertySubType) {
                          $('#property_sub_types').append($('<option>').text(propertySubType.sub_type).attr('value', propertySubType.id));
                      });


                      alert('all done. now select the old one.');

                      //$('#property_sub_types').closest('.fake-select').removeClass('loading');
                  }
              })
          }
      }

      $(document).ready(function(){
         propertyTypeChangedInSearchPopup();
      });
  </script>
@endsection