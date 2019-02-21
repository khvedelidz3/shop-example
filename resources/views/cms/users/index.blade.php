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
        <a type="button" class="btn btn-success" href="/admin/users/create" role="button">Create new
            user</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if(! is_null($user->roles))
                        <td>
                            @foreach($user->roles as $role)
                                <div>{{ucfirst($role->name)}}</div>
                            @endforeach
                        </td>
                    @endif
                    <td>
                        <a type="button" class="btn btn-warning d-inline"
                           href="/admin/users/{{$user->id}}" role="button">Update</a>
                        <form method="POST" action="/admin/users/delete/{{$user->id}}" class="d-inline">
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