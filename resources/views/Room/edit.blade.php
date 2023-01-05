@extends('layouts.app')
@section('title', 'Room')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Inventory Room Update</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rooms.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('rooms.update',$room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Room Title:</strong>
                    <input type="text" name="name" value="{{ $room->name }}" class="form-control" placeholder="Room title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Building:</strong>
                    <select name="building_id" id="">
                        @foreach ($buildings as $build )
                        <option value={{$build->id}}>{{$build->building}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
    </form>
</div>
@endsection

