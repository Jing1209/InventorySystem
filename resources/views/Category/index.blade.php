@extends('layouts.app')
@section('title')
@endsection
@section('content')
<div style="position: sticky;padding: 10px 0px 0 0px; top: 60px; overflow: hidden;background: #e4e9f7;" class="d-flex justify-content-between my-3">
    <div class="w-25 d-flex justify-content-start text-white bg-primary rounded-2 me-2">
        <a class="text-white " href="{{ url('dashboard') }}"> <i class='bx bx-home-alt p-2 m-3 rounded-2' style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i></a>
        <div class="mx-3 my-3">
            All Category
            <div>
                234
            </div>
        </div>
    </div>
    <div class=" w-75 d-flex align-items-center text-white bg-white rounded-2 me-2">
        <div class="d-flex w-100 justify-content-between">
            {{-- search bar --}}
            <form class="ms-5 w-50" action="{{ route('categories.index') }}" method="GET" role="search">
                <div class="d-flex justify-content-start">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2 w-100 ps-3" name="term" placeholder="Search Category" id="term">
                    </div>
                    <span class="input-group-btn ms-2">
                        <button class="btn btn-primary d-flex align-items-center h-100" type="submit" title="Search Category">
                            <i style=" font-size: 18px;" class='bx bx-search'></i>
                        </button>
                    </span>
                </div>
            </form>
            <a class="me-5 text-white text-decoration-none" href="{{ route('categories.create') }}">
                <div class="bg-primary cursor-pointer px-4 py-1 rounded-3 d-flex justify-conten-between">
                    <div class="me-2 d-flex align-items-center">
                        <i style="font-size: 18px;" class='bx bx-plus text-white'></i>
                    </div>
                    <span>Create Category</span>
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
        <table class="table table-borderless table-hover">
            <thead class="border-bottom">
                <tr>
                    <!-- <th scope="col">S.No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th> -->
                    <th class="col">S.No</th>
                    <th class="col">Category Name</th>
                    <th class="col">Quantity</th>
                    <th class="col" style="width: 200px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category }}</td>
                    <td>{{ $category->quantity }}</td>
                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
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
    {!! $categories->links() !!}
</div>
@endsection