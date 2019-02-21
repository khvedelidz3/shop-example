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
        <a type="button" class="btn btn-success" href="/admin/categories/create" role="button">Create category</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Parent</th>
                <th scope="col">Path</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{!is_null($category->parent) ? $category->parent->name : ''}}</td>
                    <td>{{$category->getParentsNames()}}</td>
                    <td>
                        <a type="button" class="btn btn-warning d-inline"
                           href="/admin/categories/show/{{$category->id}}" role="button">Update</a>
                        <form method="POST" action="/admin/categories/{{$category->id}}/delete" class="d-inline">
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
