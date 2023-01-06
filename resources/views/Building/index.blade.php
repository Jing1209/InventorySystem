@extends('layouts.app')
@section('title', 'Building')
@section('content')
<div style="position: sticky;padding: 10px 0px 0 0px; top: 60px; overflow: hidden;background: #e4e9f7;" class="d-flex justify-content-between my-3">
    <div class="w-25 d-flex justify-content-start text-white bg-primary rounded-2 me-2">
        <div class="mx-3 my-3">
            Total Building
            <div>
                {{$countBuilding}}
            </div>
        </div>
    </div>
    <div class=" w-75 d-flex align-items-center text-white bg-white rounded-2 me-2">
        <div class="d-flex w-100 justify-content-between">
            {{-- search bar --}}
            <form class="ms-5 w-50" action="{{ route('buildings.index') }}" method="GET" role="search">
                <div class="d-flex justify-content-start">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2 w-100 ps-3" name="term" placeholder="Search Building" id="term">
                    </div>
                    <span class="input-group-btn ms-2">
                        <button class="btn btn-primary d-flex align-items-center h-100" type="submit" title="Search Building">
                            <i style=" font-size: 18px;" class='bx bx-search'></i>
                        </button>
                    </span>
                </div>
            </form>
            <div class="me-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewBuilding"><i class="bx bx-plus-circle me-2"></i>Add New</button>
            </div>
        </div>
    </div>
</div>

{{-- {{Table}} --}}
<div>
    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="col">S.No</th>
                <th scope="col">Building Title</th>
                <th scope="col" style="width: 200px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buildings as $building)
            <tr>
                <td>{{ $building->id }}</td>
                <td>{{ $building->building }}</td>
                <td>
                    <form action="{{ route('buildings.destroy',$building->id) }}" method="Post">
<<<<<<< HEAD
                        <a href="#editBuilding{{$building->id}}" data-bs-toggle="modal" class="btn btn-primary">Edit</a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                           Delete
=======
                        <a href="#editBuilding{{$building->id}}" data-bs-toggle="modal" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(37, 178, 51);"><path d="m16 2.012 3 3L16.713 7.3l-3-3zM4 14v3h3l8.299-8.287-3-3zm0 6h16v2H4z"></path></svg>
                        </a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(212, 7, 7);"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></svg>
>>>>>>> c312d6778bd0307791b2b9758d2124b9bf07f811
                        </button>
                    </form>
                    {{-- {{ Edit pop up}} --}}
                    <div class="modal fade" id="editBuilding{{$building->id}}" tabindex="-1" aria-labelledby="editBuildingModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBuildingModalLabel">Edit Buildnig Inventory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('buildings.update',$building->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row p-3">
                                <div class="mb-3">
                                    <label class="form-label">Building Title</label>
                                    <input type="text" name="building" value="{{ $building->building }}" class="form-control"
                                        placeholder="Building Title">
                                    @error('building')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary ml-3"><i class="bx bx-save"></i>Save</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {!! $buildings->links() !!}
</div>

{{-- Addnew Building pop up --}}
<div class="modal fade" id="addnewBuilding" tabindex="-1" aria-labelledby="buildingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buildingModalLabel">Add New Building</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('buildings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Building Title</label>
                    <input type="text" class="form-control" name="building">
                    @error('building')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save</button>
                </div>
                 
            </form>
        </div>
   
      </div>
    </div>
  </div>
@endsection