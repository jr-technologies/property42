@extends('frontend.frontend')
@section('content')
    <div id="content">
       <div class="container">
            <div class="page-holder">
                <div class="agentListing-page">
                    <div class="holder">
                        {{ Form::open(array('url' => 'agents','method' => 'GET','class'=>'search-agent')) }}
                            <div class="input-holder">
                                <select  name="society" class="js-example-basic-single">
                                    <option selected disabled>Search by society</option>
                                    <option value="" @if($response['data']['params']['society'] == "") selected @endif>All Societies</option>
                                    @foreach($response['data']['societies'] as $society)
                                    <option value={{$society->id}} @if($response['data']['params']['society'] == $society->id) selected @endif>{{$society->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-holder"><input type="text" name="agency_name" placeholder="Search Your Favorite Agent"
                            value="@if($response['data']['params']['agencyName'] !=""){{$response['data']['params']['agencyName']}}@endif"></div>
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
                    <?php
                    $for_previous_link = $_GET;
                    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                    $convertPreviousToQueryString  = http_build_query($for_previous_link);
                    $previousResult = URL('/agents').'?'.$convertPreviousToQueryString;
                    ?>
                    <?php
                    $totalPaginationValue = intval(ceil($response['data']['totalAgentsFound'] / config('constants.Pagination')));
                    $for_next_link = $_GET;
                    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
                    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
                    $convertToQueryString  = http_build_query($for_next_link);
                    $nextResult = URL('/agents').'?'.$convertToQueryString;
                    ?>
                    <ul class="pager">
                        <li><a href="{{$previousResult}}" class="previous"><span class="icon-chevron-thin-left"></span></a></li>
                        <?php
                        $paginationValue = intval(ceil($response['data']['totalAgentsFound'] / config('constants.Pagination')));
                        $query_str_to_array = $_GET;
                        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
                        for($i=1; $i<=$paginationValue;$i++){
                        $query_str_to_array['page'] = $i;
                        $queryString  = http_build_query($query_str_to_array);
                        $result = URL('/agents').'?'.$queryString;
                        ?>
                        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
                        <?php }?>

                        <li><a href="{{$nextResult}}" class="next"><span class="icon-chevron-thin-right"></span></a></li>
                    </ul>
                </div>
            </div>

    </div>

</div>
@endsection