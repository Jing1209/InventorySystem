@extends('layouts.app')
@section('title', 'Sponsor')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Sponsors</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('sponsor.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div>
                <img src="" alt="">
            </div>
            <div>
                <form action="{{ route('sponsor.update',$sponsor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                <input type="text" name="name" value="{{ $sponsor->name }}" class="form-control"
                                    placeholder="Title">
                                @error('building')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection