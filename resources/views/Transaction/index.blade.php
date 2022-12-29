@extends('layouts.app')
@section('title', 'Transaction')
@section('content')
<div class="d-flex justify-content-between my-3">
    <div class="d-flex justify-content-center align-items-center">
        <h5>Transaction Summary</h5>
    </div>
    <a class="text-white text-decoration-none" href="{{ route('transactions.create') }}">
        <div class="bg-primary cursor-pointer px-4 py-1 rounded-3 d-flex justify-conten-between">
            <div class="me-2 d-flex align-items-center">
                <i style="font-size: 18px;" class='bx bx-plus text-white'></i>
            </div>
            <span>Create Transaction</span>
        </div>
    </a>
</div>
<div class="my-2 w-100 d-flex justify-content-between">
    <div class="w-50 text-white bg-primary rounded-2 me-2">
        <i class='bx bxs-folder-open p-2 m-3 rounded-2' style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-2">
            All Transactions
            <div>
                234
            </div>
        </div>
    </div>
    <div class="w-50 bg-white rounded-2">
        <i class='bx bx-color-fill p-2 m-3 rounded-2' style="background-color: rgba(255, 204, 145, 0.16); font-size: 18px;"></i>
        <div class="mx-3 my-2">
            All Transactions
            <div>
                234 
            </div>
        </div>
    </div>
</div>
<div class="bg-white p3">
    <div class="container mt-2">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Item</th>
                    <th>Room</th>
                    <th>Borrowed by</th>
                    <th>Borrowed date</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->building_id }}-{{$category->name}}</td>
                    <td>{{$category->firstname}} {{$category->lastname}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <form action="{{ route('transactions.destroy',$category->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('transactions.edit',$category->id) }}">Edit</a>
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
    {!! $transactions->links() !!}
</div>
@endsection