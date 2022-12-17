@extends('layouts.app')
@section('title', 'Transaction')
@section('content')
<div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ url('home') }}"> Home</a>
</div>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 CRUD Example Tutorial</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('transactions.create') }}"> Create Category</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Item</th>
                <th>Room</th>
                <th>Borrowed by</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->building_id }}-{{$category->name}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <form action="{{ route('transactions.destroy',$category->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('transactions.edit',$category->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
