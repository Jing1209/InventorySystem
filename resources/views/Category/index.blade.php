@extends('layouts.app')
@section('title')
Category
@endsection

@section('content')

<div class="d-flex justify-content-between mb-2">
    <div class="d-flex justify-content-center align-items-center"><h5>Category Summary</h5></div>
    <div class="bg-primary px-4 py-1 rounded-5 d-flex justify-conten-between">
         <i class='bx bx-plus'></i>  
         <a class="text-white" href="{{ route('categories.create') }}"> Create Category</a>
    </div>
</div>

<div class="bg-white p-3">
    <div class="pull-right">
        <a class="btn btn-success" href="{{ url('dashboard') }}"> Home</a>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 9 CRUD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create Category</a>
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
                    <th>Category Name</th>
                    <th>Quantity</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category }}</td>
                    <td>{{ $category->quantity }}</td>
                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
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
</div>
@endsection