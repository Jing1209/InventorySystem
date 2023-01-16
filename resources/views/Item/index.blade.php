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
        <div class="btn btn-primary d-flex justify-conten-between">
            <div class="me-2 d-flex align-items-center">
                <i style="font-size: 18px;" class='bx bx-plus text-white'></i>
            </div>
            <span>Add New</span>
        </div>
    </a>
</div>
<div class="my-2 w-100 d-flex justify-content-between">
    <div class="w-50 bg-success text-white rounded-2 me-2">
        <i class='bx bx-list-check p-2 m-3 rounded-2' style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-1">
            Good
            <div>
                {{$countGood}}
            </div>
        </div>
    </div>
    <div class="w-50 rounded-2 me-2" style="background-color: yellow;">
        <i class='bx bx-color-fill p-2 ms-3 m-3 rounded-2' style="background-color: white; font-size: 18px;"></i>
        <div class="mx-3 mt-1 ">
            Medium
            <div>
                {{$countMedium}}
            </div>
        </div>
    </div>
    <div class="w-50 bg-warning text-white rounded-2 me-2">
        <i class='bx bx-error p-2 ms-3 m-3 rounded-2' style="background-color: rgba(255, 204, 145, 1); font-size: 18px;"></i>
        <div class="mx-3 my-1">
            Bad
            <div>
                {{$countBad}}
            </div>
        </div>
    </div>
    <div class="w-50 bg-danger text-white rounded-2">
        <i class='bx bx-no-entry p-2 m-3 rounded-2' style="background-color: rgba(255, 204, 145, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-1">
            Broken
            <div>
                {{$countBroken}}
            </div>
        </div>
    </div>
</div>
{{-- search bar --}}
<div class="d-flex flex-row-reverse my-3 bg-white p-2 rounded">
    <select style="width: 200px;" class="form-select ms-2" aria-label="selectStatus" name='term'>
        <option selected>Status</option>
        <option value="1">Good</option>
        <option value="2">Medium</option>
        <option value="3">Bad</option>
        <option value="4">Broken</option>
    </select>
    <form class="w-25" action="{{ route('items.index') }}" method="GET" role="search">
        <div class="d-flex justify-content-start">
            <div class="input-group">
                <input type="text" class="form-control mr-2 w-100 ps-3" name="term" placeholder="Search Item" id="term">
            </div>
            <span class="input-group-btn ms-2">
                <button class="btn btn-primary d-flex align-items-center h-100" type="submit" title="Search Item">
                    <i style=" font-size: 18px;" class='bx bx-search'></i>
                </button>
            </span>
        </div>
    </form>
</div>

<div class="mt-1 rounded bg-white">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div>
        <table class="table table-striped table-hover">
            <thead class="border-bottom">
                <tr class="table-primary">
                    <th class="col" style="padding-left: 20px;">S.No</th>
                    <th class="col">ID</th>
                    <th class="col">Item</th>
                    <th class="col">Category</th>
                    <th class="col">Price</th>
                    <th class="col">Status</th>
                    <th class="col">Sponsor</th>
                    <th scope="col" style="width: 200px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td style="padding-left: 20px;">{{ $item->id }}</td>
                    <td>{{$item->item_id}}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->price}}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="text-align: center;">
                        <form action="{{ route('items.destroy',$item->id) }}" method="Post">
                            <a class="btn btn-warning text-white" href="#viewItem{{ $item->id }}" data-bs-toggle="modal">View</a>
                            <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <a href="#deleteClarify{{$item->id}}" data-bs-toggle="modal" class="btn btn-danger">
                                Delete
                            </a>
                            {{-- Comfirm Delete Item  --}}
                            <div class="modal fade" id="deleteClarify{{$item->id}}" tabindex="-1" aria-labelledby="deleteBuildingModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBuildingModalLabel">Confirm Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('items.destroy',$item->id) }}" method="Post">

                                            @csrf
                                            @method('DELETE')
                                            <div class="p-3">Are you sure you want to delete this item?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- View an item  --}}
                        <div class="modal fade" id="viewItem{{ $item->id }}" tabindex="-1" aria-labelledby="ViewEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewItemModalLabel">Item Inventory</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$item->id}} 
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
    {!! $items->links() !!}
</div>
@endsection