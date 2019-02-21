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

        <form method="POST" action="/admin/products/create" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="productName">Product name</label>
                <input type="text" class="form-control" id="productName" name="productName">
                @if ($errors->has('productName'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="productDescription">Product description</label>
                <input type="text" class="form-control" id="productDescription" name="productDescription">
            </div>

            <div class="form-group">
                <label for="productPrice">Product price</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice">
            </div>

            <div class="form-group">
                <label for="productImg">Product img</label>
                <input type="file" class="form-control" id="productImg" name="productImg[]">

                <input type="file" class="form-control" id="productImg" name="productImg[]">

                <input type="file" class="form-control" id="productImg" name="productImg[]">

                <input type="file" class="form-control" id="productImg" name="productImg[]">

                <input type="file" class="form-control" id="productImg" name="productImg[]">
            </div>


            <div class="form-group mt-2">
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
            </div>

            <div class="form-group">
                @foreach($sizes as $index => $size)
                    <div>
                        <input type="checkbox" name="product[{{$index}}][size]" value="{{$size->size}}"
                               class="form-group">
                        <label>{{$size->size}}</label>
                        <input type="text" name="product[{{$index}}][quantity]">
                    </div>
                @endforeach

            </div>

            <input type="submit" value="Create" role="button" class="btn btn-primary">
        </form>
    </div>

@endsection