@extends('layouts.app')
@section('title')
Room
@endsection

@section('content')
<div class="row my-2">
    <div class="container pull-left">
        <h2>Inventory Room</h2>
    </div>
    <div class="d-flex flex-row-reverse my-3">
        <div class="container p-5 bg-light text-white rounded-2">
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)"><path d="M19 2H9c-1.103 0-2 .897-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4c0-1.103-.897-2-2-2zM5 12h6v8H5v-8zm14 8h-6v-8c0-1.103-.897-2-2-2H9V4h10v16z"></path><path d="M11 6h2v2h-2zm4 0h2v2h-2zm0 4.031h2V12h-2zM15 14h2v2h-2zm-8 .001h2v2H7z"></path></svg></h1>
        </div>
        <div class="container p-5 bg-light text-white me-3 rounded-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M18 2H6c-1.103 0-2 .897-2 2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4c0-1.103-.897-2-2-2zm0 18H6V4h12v16z"></path><path d="M8 6h3v2H8zm5 0h3v2h-3zm-5 4h3v2H8zm5 .031h3V12h-3zM8 14h3v2H8zm5 0h3v2h-3z"></path></svg>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{-- search bar --}}
    <div class="d-flex mb-3 justify-content-between">
    
        <div class="col-6 pe-2">
            <div class="">
                <form action="{{ route('buildings.index') }}" method="GET" role="search">
    
                    <div class="input-group">
                       
                        <input type="text" class="form-control mr-2 rounded-2" name="term" placeholder="Search projects" id="term">
                        <a href="{{ route('buildings.index') }}" class="ms-1">
                            <button class="btn btn-primary" type="submit" title="Search projects">
                                <span class="bx bx-search"></span>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewRoom"><i class="bx bx-plus-circle me-2"></i>Add New</button>
        </div>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr class="table-primary">
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
                                <a href="#editRoom{{$room->id}}" data-bs-toggle="modal" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(37, 178, 51);transform: ;msFilter:;"><path d="m16 2.012 3 3L16.713 7.3l-3-3zM4 14v3h3l8.299-8.287-3-3zm0 6h16v2H4z"></path></svg>
                                </a> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(212, 7, 7);transform: ;msFilter:;"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></svg>
                                </button>
                            </form>
                            {{-- {{ Edit pop up}} --}}
                            <div class="modal fade" id="editRoom{{$room->id}}" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room Inventory</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('rooms.update',$room->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Room Title</label>
                                                    <input type="text" name="name" value="{{ $room->name }}" class="form-control" placeholder="Room title">
                                                </div>
                                                <div class="mb-3 d-flex flex-column">
                                                    <label class="form-label">Building Title</label>
                                                    <select name="building_id" class="p-2 rounded-2">
                                                        @foreach ($buildings as $build )
                                                        <option value={{$build->id}}>{{$build->building}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-primary ml-3"><i class="bx bx-save"></i>Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                            
                        </td>                   
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   

</div>
<div class="d-flex justify-content-center">
    {!! $rooms->links() !!}
</div>

{{-- Addnew Building pop up --}}
<div class="modal fade" id="addnewRoom" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="roomModalLabel">Add New Building</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Room Title</label>
                        <input type="text" name="name" class="form-control" placeholder="Room">
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="form-label">Building Title</label>
                        <select name="building_id" class="p-2 rounded-2">
                            @foreach ($buildings as $build )
                            <option value={{$build->id}}>{{$build->building}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary ml-3"><i class="bx bx-save"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
   
      </div>
    </div>
  </div>

@endsection
