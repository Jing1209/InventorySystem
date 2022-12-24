@extends('layouts.app')
@section('title')
Item
@endsection

@section('content')
<div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ url('dashboard') }}"> Home</a>
</div>
{{-- @foreach($categories as $cate)
            <p>{{$cate->id}}</p>
@endforeach --}}
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 CRUD Example Tutorial</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('items.create') }}"> Create Item</a>
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
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Sponsor</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)

            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->price}}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>
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
