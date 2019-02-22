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
        <div class="row mt-3 mb-3">
            <div class="col-4">
                <form action="/admin/orders" method="get">
                    @csrf
                    <label>Filter By Status</label>
                    <select name="filter" class="form-group form-control d-inline mt-2 col-6">
                        <option selected></option>
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->status_name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Get" class="btn btn-primary d-inline mt-0 mb-2 col-2">
                </form>
            </div>

            <div class="col-7">
                <form action="/admin/orders" class="mt-3 mb-3 d-inline">
                    @csrf
                    <input type="text" class="form-control col-6 d-inline mt-2" name="search"
                           placeholder="Search by order id or user id">
                    <input type="submit" class="btn btn-primary mb-1 col-3 mt-0 mb-2" value="Search">
                </form>
            </div>

        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Order id</th>
                <th scope="col">User id</th>
                <th scope="col">User email</th>
                <th scope="col">Product id</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->user->email}}</td>
                    <td>{{$order->product_id}}</td>
                    <td>
                        <form action="/admin/orders/{{$order->id}}/update" method="POST">
                            @csrf
                            <select name="status" class="form-control">
                                @foreach($statuses as $status)
                                    <option {{$status->id == $order->status->id?'selected' : ''}} value="{{$status->id}}">
                                        {{$status->status_name}}
                                    </option>
                                @endforeach
                            </select>
                            <input type="submit" class="btn btn-warning d-inline mt-2" value="Update Status">
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection