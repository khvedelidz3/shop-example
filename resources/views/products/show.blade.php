@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <h5>{{ $stockLevel }}</h5>
                        <h4>{{ $product->price }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="order">
                        <form method="POST" action="/products/{{$product->id}}">
                            @csrf
                            <input type="submit" value="Order">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection