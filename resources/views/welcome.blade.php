@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 35%">
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
   
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" align="center">  
      <div class="item active">
        <img src="/items/Splinter_Cell_Limited_Edition.jpg">
      </div>

      <div class="item">
        <img src="/items/bicycle_2-wallpaper-2560x1600.jpg">
      </div>

      <div class="item">
        <img src="/items/misery-300x267.jpg">
      </div>

      <div class="item">
        <img src="/items/bmw-320-dalimis-parduodamas-bmw-e46-320d-2000-metu-dalimis.jpg">
      </div>    
    </div>
   
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>            
</div>

<div style="margin-left: 25%; margin-right: 10%; padding-top: 5%">
@foreach($items as $key => $value)
    <div class="box-set" style="float: left; width: 300px">
        <div class="itemBox" style="">
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

<div style="clear: left; margin-left: 25%;">
  {{ $items->links() }}
</div>

<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 800px;
      height: 350px;
      margin: auto;
  }

  #myCarousel{
    width: 800px;
    height: 300px;  
  }
  .carousel-control.left, .carousel-control.right {
    background-image: none
  }
</style>

@endsection

