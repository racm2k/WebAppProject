@extends('layouts.app')

@section('title')
    Home Page
@endsection

@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
          <img style="height: 300px" src="{{URL::to('/slide1.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div  class="carousel-item">
        <img style="height: 300px" src="{{URL::to('/slide2.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div  class="carousel-item">
        <img style="height: 300px" src="{{URL::to('/slide3.jpg')}}" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>
@endsection