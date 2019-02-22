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
        <form action="/admin/categories/create" method="POST">
            @csrf
            <div class="form-group">
                <label for="parentCategoryName">Category name</label>
                <input type="text" class="form-control" id="parentCategoryName" name="categoryName">
                @if ($errors->has('categoryName'))
                    <div class="text-danger">{{$errors->first('categoryName')}}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="slugName">Slug name</label>
                <input type="text" class="form-control" id="slugName" name="slugName">
                @if ($errors->has('slugName'))
                    <div class="text-danger">{{$errors->first('slugName')}}</div>
                @endif
            </div>

            <label>Select parent category</label>
            <select name="parentCategory" id="parentCategory" class="form-control form-group select">
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

            <input type="submit" class="btn btn-primary" role="button" value="Create">
        </form>
    </div>



@endsection