@extends('layouts.app')

@section('content')
<div class="container">
    <div>
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
</div>
@endsection
