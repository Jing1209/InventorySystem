@extends('layouts.app')
@section('title')
Employee
@endsection

@section('content')
<div style="height: 85vh;" class="m-3 mb-5 bg-white rounded-3">
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-around">
            <div class="row m-3">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-start">
                        <i style="font-size: 30px;" class='bx bxs-user'></i>
                        <h3 class="ms-3">Create New Employee!</h3>
                    </div>
                </div>
                <div class="">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="lastname">Firstname</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Firstname">
                            {{-- @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}
                        </div>
                        @enderror --}}
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Lastname">
                    </div>
                </div>
                <div class="">
                    <label for="lastname">Gender</label>
                    <select class="custom-select">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="lastname">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="lastname">Phone number</label>
                        <input type="number" name="phone_number" class="form-control" placeholder="Phone number">
                    </div>
                </div>
                <div class="">
                    <div class="">
                        {{-- <label>Sponsor by:</label> --}}
                    </div>
                </div>
                <div class="">
                    <a class="btn btn-secondary" href="{{ route('employees.index') }}"> Back</a>
                    <button type="submit" class="btn btn-primary ms-2"><i class="bx bx-save pe-1"></i>Save</button>
                </div>
            </div>
        </div>
        <div class="">
            <label>Choose Images</label>
            <input type="file" name="images" onchange="loadFile(event)">
            <img id="output" width="200" />
        </div>
    </form>
</div>
<script type="text/javascript">
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection