@extends('layout.app')
@section('content')
 <!-- Slide gallery -->
 <div class="jumbotron">
  <div class="container">
    <div class="col-xs-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{asset('img/carousel1.jpg')}}" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img src="{{asset('img/carousel2.jpg')}}" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img src="{{asset('img/carousel3.jpg')}}" alt="">
          <div class="carousel-caption">
          </div>
        </div>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
    </div>
  </div><!-- End Slide gallery -->
</div>

<!-- Thumbnails -->
<div class="container thumbs">
  <div class="row">
    @foreach ($post as $item)
    <div class="col-sm-6 col-md-4 d-flex align-items-stretch mb-4">
      <div class="thumbnail d-flex flex-column">
        <img src="{{asset('img/pic1.jpg')}}" alt="" class="img-responsive">
        <div class="caption">
          <h3 class="">{{$item->title}}</h3>
          <p>{!! $item->description !!}</p>
          <div class="btn-toolbar text-center mt-auto">
            <a href="#" role="button" class="btn btn-primary pull-right">Details</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection