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

    {{-- search bar --}}
    <div class="mx-auto pull-right">
        <div class="">
            <form action="{{ route('items.index') }}" method="GET" role="search">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Search projects">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="term" placeholder="Search projects"
                        id="term">
                    <a href="{{ route('items.index') }}" class=" mt-1">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                <span class="fas fa-sync-alt"></span>
                            </button>
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>

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
<div class="d-flex justify-content-center">
    {!! $items->links() !!}
</div>
@endsection
