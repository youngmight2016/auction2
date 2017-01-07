@extends('layouts.app')

@section('content')
<script>
function ConfirmDelete(){
    var x = confirm("Are you sure you want to delete?");
    if (x)
    return true;
    else
    return false;
}
</script>

<div class="container" style="margin-left: 25%;">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{     Session::get('message') }}</p>
    @endif


    @if(count($items) === 0)
        Nera sio vartotojo itemu
    @else
    <h1>{{ Auth::user()->name }} items:</h1>
        <table class="table table-striped table-bordered" style="width: 1200px;">
            <thread>
                <tr align="center">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Sub_Category</th>
                    <th>Picture</th>
                    <th>End_date</th>
                    <th>Your Starting Bid</th>
                    <th>Show</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thread>
            @foreach($items as $key => $value)
              <tr>
                <td align="center">{{ $value->title }}</td>
                <td align="center">{{ $value->description }}</td>
                <td align="center">{{ $value->category }}</td>
                <td align="center">{{ $value->subcategory }}</td>
                <td align="center"><img src="/items/{{ $value->picture }}" style="width: 180px; height: 100px; margin-top:15px"></td>
                <td align="center">{{ $value->end_date }}</td>
                <td align="center">{{ $value->bid }}</td>
                <td align="center"><a href="{{ URL::to('showItem/' . $value->id) }}" class="btn btn-primary" role="button">Show me</a></td>
                <td align="center"><a href="{{ URL::to('editItem/' . $value->id) }}" class="btn btn-warning" role="button">Edit</a></td>
                <td>
                    {{ Form::open(array('url' => '/userItems', 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
                        {{ Form::hidden('item_id', $value->id) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete this Item', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </td>
              </tr>
            @endforeach      
        </table>
    @endif 
</div>
@endsection