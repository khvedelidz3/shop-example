@extends('cms.master')
@section('content')

    @if($errors->has('permissionError'))
        <div class="alert alert-warning">
            <p class="text-center">{{$errors->first('permissionError')}}</p>
        </div>
    @elseif ($errors->has('error'))
        <div class="alert alert-warning">
            <p class="text-center">{{$errors->first('error')}}</p>
        </div>
    @endif

    <div class="container">
        <a type="button" class="btn btn-success" href="/admin/products/create" role="button">Create new
            product</a>

        <form action="/admin/products" class="mt-3 mb-3">
            @csrf
                <input type="text" class="form-control col-3 d-inline" name="search" placeholder="Search by id or name">
                <input type="submit" class="btn btn-primary mb-1" value="Search">
        </form>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Picture</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <th scope="row"><img
                                src="{{asset('storage/'.floor($product->id/1000).'/'.$product->images->first()->id .'.' .$product->images->first()->ext)}}"
                                alt="img" class="product-img"></th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{ $product->categories->name}}</td>
                    <td>
                        <a type="button" class="btn btn-warning d-inline" href="/admin/products/update/{{$product->id}}"
                           role="button">Update</a>

                        <form method="POST" action="/admin/product/delete/{{$product->id}}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
