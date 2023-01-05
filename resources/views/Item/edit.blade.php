@extends('layouts.app')
@section('title')
Item
@endsection

@section('content')
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Company</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('items.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $item->title }}" class="form-control"
                            placeholder="Title">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category:</strong>
                        <select name="category_id" id="">
                            @foreach ($categories as $cate )
                                <option value={{$cate->id}}>{{$cate->category}}</option>
                            @endforeach
                        </select>
                        {{-- @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <select name="status" id="">
                            @foreach ($status as $cate )
                                <option value={{$cate->id}}>{{$cate->status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sponsor:</strong>
                        <select name="sponsored" id="">
                            @foreach ($sponsor as $cate )
                                <option value={{$cate->id}}>{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="number" name="price" value="{{ $item->price }}" class="form-control"
                            placeholder="Price">
                        {{-- @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </div>
                @foreach ($items as $image)
                    {{-- {{$image->url}} --}}
                    <img src="{{ url('public/Image/'.$image->url) }}" alt="">
                @endforeach
                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
