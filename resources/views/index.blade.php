@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <div class="row">
      			@if(count($products) > 0)

      			@foreach($products as $product)
                  <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card">
                      <a href="#"><img class="card-img-top" src="http://placehold.it/150x150" alt=""></a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="/products/{{ $product->id }}">{{ $product->name }}</a>
                        </h4>
                        <h5>${{ $product->price }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-muted">{{ $product->created_at->toFormattedDateString() }}</small>
                      </div>
                    </div>
                  </div>
      			@endforeach

      			@endif
          </div>
        </div>
      </div>
    </div>
@endsection