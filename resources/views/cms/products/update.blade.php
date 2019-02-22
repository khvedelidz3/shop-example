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
        <a href="{{URL::previous()}}" class="btn btn-secondary mb-2 mt-2">Go back</a>

        <form method="POST" action="/admin/products/update/{{$product->id}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="productName">Product name</label>
                <input type="text" class="form-control" id="productName" name="productName" value="{{$product->name}}">
                @if ($errors->has('productName'))
                    <div class="text-danger">{{$errors->first('productName')}}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="productDescription">Product description</label>
                <input type="text" class="form-control" id="productDescription" name="productDescription"
                       value="{{$product->description}}">
                @if ($errors->has('productDescription'))
                    <div class="text-danger">{{$errors->first('productDescription')}}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="productPrice">Product price</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice"
                       value="{{$product->price}}">
                @if ($errors->has('productPrice'))
                    <div class="text-danger">{{$errors->first('productPrice')}}</div>
                @endif
            </div>

            @foreach($product->images as $image)
                <div class="form-group">
                    <img src="{{asset('storage/'.floor($product->id/1000).'/'.$image->id .'.' . $image->ext)}}"
                         alt="img" class="product-img">
                    <input type="file" name="productImg[{{$image->id}}]">
                </div>
            @endforeach
            @if ($errors->has('product-img'))
                <div class="text-danger">{{$errors->first('product-img')}}</div>
            @endif

            <div class="form-group">
                <label for="productCategory">Select category</label>
                <select name="productCategory" id="productCategory" class="form-control">
                    <option hidden></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                        @if(count($category->children))
                            @include('cms/category/manageChild',['children' => $category->children])
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('productCategory'))
                    <div class="text-danger">{{$errors->first('productCategory')}}</div>
                @endif
            </div>

            <div class="form-group">
                @foreach($sizes as $index => $size)
                    <div>
                        <input type="checkbox" name="product[{{$index}}][size]" value="{{$size->size}}"
                                {{$product->attributes->contains('size', $size->size)?'checked' : ''}}
                        >
                        <label>{{$size->size}}</label>
                        <input type="text" name="product[{{$index}}][quantity]"
                               value="@for($i=0; $i < count($product->attributes); $i++)@if ($product->attributes[$i]['size'] == $size->size){{$product->attributes[$i]['quantity']}}@break @endif @endfor">
                    </div>
                @endforeach

            </div>

            <input type="submit" value="Update" role="button" class="btn btn-primary">
        </form>
    </div>

@endsection