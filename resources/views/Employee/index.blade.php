@extends('layouts.app')
@section('title', 'Employee')
@section('content')
<div class="d-flex justify-content-between my-3">
    <div class="w-25 d-flex justify-content-start text-white bg-primary rounded-2 me-2">
        <a class="text-white " href="{{ url('dashboard') }}"> <i class='bx bx-home-alt p-2 m-3 rounded-2' style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i></a>
        <div class="mx-3 my-3">
            All Employees
            <div>
                234
            </div>
        </div>
    </div>
    <div class=" w-75 d-flex align-items-center text-white bg-white rounded-2 me-2">
        <div class="d-flex w-100 justify-content-between">
            {{-- search bar --}}
            <form class="ms-5 w-50" action="{{ route('employees.index') }}" method="GET" role="search">
                <div class="d-flex justify-content-start">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2 w-100 ps-3" name="term" placeholder="Search Employee" id="term">
                    </div>
                    <span class="input-group-btn ms-2">
                        <button class="btn btn-primary d-flex align-items-center h-100" type="submit" title="Search projects">
                            <i style=" font-size: 18px;" class='bx bx-search'></i>
                        </button>
                    </span>
                </div>
            </form>
            <a class="me-5 text-white text-decoration-none" href="{{ route('employees.create') }}">
                <div class="bg-primary cursor-pointer px-4 py-1 rounded-3 d-flex justify-conten-between">
                    <div class="me-2 d-flex align-items-center">
                        <i style="font-size: 18px;" class='bx bx-plus text-white'></i>
                    </div>
                    <span>Create Employee</span>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="mt-1 rounded bg-white">
    <div class="row">
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="m-3">
        <table class="table table-hovers">
            <thead>
                <tr>
                    <th class="col">S.No</th>
                    <th class="col">Firstname</th>
                    <th class="col">Lastname</th>
                    <th class="col">Gender</th>
                    <th class="col">Email</th>
                    <th class="col">Phone Number</th>
                    <th class="col" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->firstname }}</td>
                    <td>{{ $item->lastname }}</td>
                    <td>{{ $item->gender}}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td>
                        <form action="{{ route('employees.destroy',$item->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('employees.edit',$item->id) }}">Edit</a>
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
</div>
<div class="d-flex justify-content-center">
    {!! $employees->links() !!}
</div>
@endsection