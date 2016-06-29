@extends('frontend.frontend')
@section('content')
    <div id="content">
       <div class="container">
            <div class="page-holder">
                <div class="agentListing-page">
                    <div class="holder">
                        {{ Form::open(array('url' => 'agents','method' => 'GET','class'=>'search-agent')) }}
                            <div class="input-holder">
                                <select  name="society" >
                                    <option selected disabled>Search by society</option>
                                    <option value="" @if($response['data']['params']['society'] == "") selected @endif>All Societies</option>
                                    @foreach($response['data']['societies'] as $society)
                                    <option value={{$society->id}} @if($response['data']['params']['society'] == $society->id) selected @endif>{{$society->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-holder"><input type="text" name="agency_name" placeholder="Search Your Favorite Agent"
                            value=@if($response['data']['params']['agencyName'] !=""){{$response['data']['params']['agencyName']}}@endif></div>
                            <input type="submit" value="Search Agent">
                        {{Form::close()}}
                    </div>

                    <section class="property-posts">
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
                        <article class="post">
                            <div class="post-holder">
                                <div class="img-holder">
                                    <a href="{{ URL::to('agent?agent_id='.$agent->id) }}">
                                        <img src="{{$image}}" width="300" height="300" alt="image description">
                                    </a>
                                </div>
                                <div class="caption">
                                    <strong class="post-heading"><a href="{{ URL::to('agent?agent_id='.$agent->id) }}">{{$agent->agencies[0]->name}}</a></strong>
                                    <p>{{str_limit($agent->agencies[0]->description,150)}}</p>
                                    <div class="holder">
                                        <ul class="quick-links">
                                            <li><a href="tel:{{$agent->agencies[0]->mobile}}"><span class="icon-phone_iphone"></span><span class="hidden-xs">{{$agent->agencies[0]->mobile}}</span><span class="show-xs">Call Now</span></a></li>
                                            <li><a href="{{ URL::to('agent?agent_id='.$agent->id) }}"><span class="icon-pencil"></span>View Details</a></li>
                                        </ul>
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
                </div>
            </div>

    </div>

</div>
@endsection