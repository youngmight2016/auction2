@extends('layouts.app')

@section('content')
<h2 style="margin-left: 20%;">You searched for: {{ $query }}</h2>
<div class="container">
	@if (count($items) === 0)
		<div>No items found</div>
	@else
		<div style="margin-left: 20%">
	    @foreach($items as $key => $value)
	        <div class="box-set" style="float: left; width: 300px">
	            <div class="itemBox">
	                <div class="thumbnail">
	                  <img src="/items/{{ $value->picture }}" style="width: 250px; height: 150px; border-radius: 10px;">
	                    <h3 align="center">{{ $value->title }}</h3>
	                    <h5 align="center">Starting price only {{ $value->bid }} !!!</h5>
	                    <h5 align="center">The auction for this item ends at {{ $value->end_date }}</h5>
	                    <p align="center"><a href="{{ URL::to('showItem/' . $value->id) }}" class="btn btn-primary" role="button">Check it out</a></p>
	                </div>
	            </div>
	        </div> 
	    @endforeach  
	    </div>
	@endif

    <div style="clear: left; margin-left: 20%;">
      {{ $items->links() }}
    </div>
</div>


@endsection