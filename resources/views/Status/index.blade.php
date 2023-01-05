@extends('layouts.app')
@section('title', 'Building')
@section('content')
<div class="row my-3">
    <div class="container pull-left">
        <h2>Inventory Status</h2>
    </div>
    <div class="d-flex flex-row-reverse my-3">
        <div class="container p-3 bg-light rounded-2">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgb(21, 59, 182);transform: ;msFilter:;"><path d="M12 10c3.976 0 8-1.374 8-4s-4.024-4-8-4-8 1.374-8 4 4.024 4 8 4z"></path><path d="M4 10c0 2.626 4.024 4 8 4s8-1.374 8-4V8c0 2.626-4.024 4-8 4s-8-1.374-8-4v2z"></path><path d="M4 14c0 2.626 4.024 4 8 4s8-1.374 8-4v-2c0 2.626-4.024 4-8 4s-8-1.374-8-4v2z"></path><path d="M4 18c0 2.626 4.024 4 8 4s8-1.374 8-4v-2c0 2.626-4.024 4-8 4s-8-1.374-8-4v2z"></path></svg>
                Status Borrow
            </p>
            <ul>
                <li>Instock</li>
                <li>Borrow</li>
                <li>Suggest to have</li>
            </ul>
           
        </div>
        <div class="container p-3 bg-light me-3 rounded-2">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgb(217, 31, 14);transform: ;msFilter:;"><path d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z"></path></svg>
                Status Item
            </p>
            <ul>
                <li>Good</li>
                <li>Medium</li>
                <li>Usable</li>
                <li>Broken</li>
            </ul>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="d-flex mb-3 justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewStatus"><i class="bx bx-plus-circle me-2"></i>Add New</button>
    </div>
    <div>
        <table class="table table-striped">
        <thead>
            <tr class="table-primary">
                <th>S.No</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->status }}</td>
                <td>
                    <form action="{{ route('status.destroy',$status->id) }}" method="Post">
                        <a href="#editStatus{{$status->id}}" data-bs-toggle="modal" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(37, 178, 51);transform: ;msFilter:;"><path d="m16 2.012 3 3L16.713 7.3l-3-3zM4 14v3h3l8.299-8.287-3-3zm0 6h16v2H4z"></path></svg>
                        </a> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(212, 7, 7);transform: ;msFilter:;"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></svg>
                        </button>
                    </form>
                    {{-- {{ Edit pop up}} --}}
                    <div class="modal fade" id="editStatus{{$status->id}}" tabindex="-1" aria-labelledby="editStatus" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editStatusModalLabel">Edit Status Inventory</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('status.update',$status->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row p-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status Title</label>
                                        <input type="text" name="status" value="{{ $status->status }}" class="form-control"
                                            placeholder="Building Title">
                                        @error('status')
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
    </table></div>
    
</div>
<div class="d-flex justify-content-center">
    {!! $statuses->links() !!}
</div>
{{-- Addnew status pop up --}}
<div class="modal fade" id="addnewStatus" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel">Add New Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('status.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Status Title</label>
                    <input type="text" class="form-control" name="status">
                    @error('status')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary ml-3"><i class="bx bx-save"></i>Save</button>
                </div>
                 
            </form>
        </div>
   
      </div>
    </div>
  </div>

@endsection