@extends('admin.admin2')
@section('content')

    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <table style="width:50%">
            <tr>
                    <th>Enter Block</th>
            </tr>
            <tr>

                {{Form::open(array('url'=> 'add/blocks','method'=>'POST','class'=>'rejectApprove-form'))}}
                <td>
                    <select name="society_id">
                        @foreach($response['data']['societies'] as $society)
                            <option value="{{$society->id }}" >{{$society->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="block_name" value="" placeholder="please Enter society"><br /><br />
                    <button type="submit">Add Block</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>

    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <table style="width:50%">

              <tr>
                <th>Block ID</th>
                <th>Society Name</th>
                <th>Block Name</th>
                <th>Action</th>
                  </tr>
            @foreach($response['data']['blocks'] as $blocks)
                <tr>
                    <td>{{$blocks->id}}</td>
                    <td>{{$blocks->society}}</td>
                    <td>{{$blocks->block}}</td>
                    <td>
                        {{Form::open(array('url'=>'delete/blocks','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="block_id" value="{{$blocks->id}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}
                        {{Form::open(array('url'=>'get/update/block/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="block_id" value="{{$blocks->id}}">
                        <button><span type="submit" ></span>Update</button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


@endsection