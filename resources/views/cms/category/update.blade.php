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
        <form action="/admin/categories/{{$currentCategory->id}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="categoryName">Category name</label>
                <input type="text" class="form-control" id="categoryName" value="{{$currentCategory->name}}" name="categoryName">
                @if ($errors->has('categoryName'))
                    <div class="text-danger">{{$errors->first('categoryName')}}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="parentCategory">Parent category name</label>

                <select name="parentCategory" id="parentCategory" class="form-control">
                    <option hidden selected></option>
                    @foreach($cats as $key => $cat)
                        <option value="{{$key}}">
                            {{$cat}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" value="{{$currentCategory->slug}}" name="slugName">
                @if ($errors->has('slugName'))
                    <div class="text-danger">{{$errors->first('slugName')}}</div>
                @endif
            </div>
            <input type="submit" class="btn btn-primary" role="button" value="Save">
        </form>
    </div>

@endsection