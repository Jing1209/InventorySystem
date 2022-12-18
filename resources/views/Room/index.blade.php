@extends('layouts.app')
@section('title')
Room
@endsection

@section('content')
<div class="pull-right mb-2">
        <a class="btn btn-success" href="{{ url('home') }}"> Home</a>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Inventory Room List</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('rooms.create') }}"> Create Item</a>
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
                    <th>Room title</th>
                    <th>Building</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->building }}</td>                     
                        <td>
                            <form action="{{ route('rooms.destroy',$room->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('rooms.edit',$room->id) }}">Edit</a>
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
