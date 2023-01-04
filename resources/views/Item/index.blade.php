@extends('layouts.app')
@section('title')
Item
@endsection

@section('content')
<div class="d-flex justify-content-between my-3">
    <div class="d-flex justify-content-center align-items-center">
        <h5>Item Summary</h5>
    </div>
    <a class="text-white text-decoration-none" href="{{ route('items.create') }}">
        <div class="bg-primary cursor-pointer px-4 py-1 rounded-3 d-flex justify-conten-between">
            <div class="me-2 d-flex align-items-center">
                <i style="font-size: 18px;" class='bx bx-plus text-white'></i>
            </div>
            <span>Create Item</span>
        </div>
    </a>
</div>
<div class="my-2 w-100 d-flex justify-content-between">
    <div class="w-50 text-white bg-primary rounded-2 me-2">
        <i class='bx bxs-folder-open p-2 m-3 rounded-2' style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-2">
            All Items
            <div>
                234
            </div>
        </div>
    </div>
    <div class="w-50 bg-white rounded-2">
        <i class='bx bx-color-fill p-2 m-3 rounded-2' style="background-color: rgba(255, 204, 145, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-2 text-danger">
            Low Stock Items
            <div class="text-black">
                234 
            </div>
        </div>
    </div>
</div>
<div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ url('dashboard') }}"> Home</a>
</div>
{{-- @foreach($categories as $cate)
            <p>{{$cate->id}}</p>
@endforeach --}}
<div class="container mt-2">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    {{-- search bar --}}
    <div class="mx-auto pull-right">
        <div class="">
            <form action="{{ route('items.index') }}" method="GET" role="search">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Search projects">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="term" placeholder="Search projects"
                        id="term">
                    <a href="{{ route('items.index') }}" class=" mt-1">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                <span class="fas fa-sync-alt"></span>
                            </button>
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                {{-- <th>Image</th> --}}
                <th>Item</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Sponsor</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)

            <tr>
                <td>{{ $item->id }}</td>
                {{-- <td>{{url('public/Image/'.$item->url)}}</td> --}}
                <td>{{ $item->title }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->price}}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>
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
<div class="d-flex justify-content-center">
    {!! $items->links() !!}
</div>
@endsection
