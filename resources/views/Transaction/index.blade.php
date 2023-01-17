@extends('layouts.app')
@section('title', 'Transaction')
@section('content')
<div class="container text-center">
    <h2 class="modal-title p-2" id="buildingModalLabel">Transaction Inventory</h2>
</div>
    <div style="position: sticky; top:60px; overflow: hidden; background: #e4e9f7;">
        <div class="d-flex justify-content-between my-3">
            <div class="w-50 text-white bg-primary rounded-2 me-2">
                <i class='bx bxs-folder-open p-2 m-3 rounded-2'
                    style="background-color: rgba(255, 255, 255, 0.16); font-size: 18px;"></i>
                <div class="mx-3 my-2">
                    Borrow
                    <div>
                        {{$countBorrow}}
                    </div>
                </div>
            </div>
            <div class="w-50 bg-white rounded-2">
                <i class='bx bx-color-fill p-2 m-3 rounded-2'
                    style="background-color: rgba(255, 204, 145, 0.16); font-size: 18px;"></i>
                <div class="mx-3 my-2">
                    Return
                    <div>
                        {{$countReturn}}
                    </div>
                </div>
            </div>
            <div class="text-white text-decoration-none" >
                <button type="button" class="btn btn-primary d-flex align-items-center rounded d-flex justify-conten-between"
                    data-bs-toggle="modal" data-bs-target="#addNewTransaction">
                    <span><i class="bx bx-plus-circle me-2"></i>Add New</span>
                </button>
            </div>
           
        </div>
        <div class="my-2 w-100 d-flex justify-content-between">
            
            
        </div>
    </div>
    <div class="bg-white rounded">
        <div class="mt-2">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-striped table-hover">
                <thead class="border-bottom">
                    <tr class="table-primary">
                        <th style="text-align: center;">S.No</th>
                        <th>Item</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Borrowed by</th>
                        <th>Borrowed date</th>
                        <th scope="col" style="width: 200px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td style="text-align: center;">{{ $transaction->id }}</td>
                            <td>{{ $transaction->title }}</td>
                            <td>{{ $transaction->building_id }}-{{ $transaction->name }}</td>
                            <td>{{$transaction->status}}</td>
                            <td>{{ $transaction->firstname }} {{ $transaction->lastname }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="Post">
                                    <a class="btn btn-primary" href="#editTransaction{{ $transaction->id }}"
                                        data-bs-toggle="modal">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <a href="#deleteClarify{{$transaction->id}}" data-bs-toggle="modal" class="btn btn-danger">
                                        Delete
                                    </a> 
                                     {{-- Comfirm Delete Room  --}}
                                    <div class="modal fade" id="deleteClarify{{$transaction->id}}" tabindex="-1" aria-labelledby="deleteBuildingModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBuildingModalLabel">Confirm Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('transactions.destroy',$transaction->id) }}" method="Post">
                                               
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-3">Are you sure you want to delete this transaction?</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- {{ Edit pop up}} --}}
                                <div class="modal fade" id="editTransaction{{ $transaction->id }}" tabindex="-1"
                                    aria-labelledby="editTransactionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTransactionModalLabel">Update Transaction
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('transactions.update', $transaction->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="mb-3 d-flex flex-column">
                                                            <label class="col-form-label d-flex">Item:</label>
                                                            <select name="item_id" class="p-2 rounded-2">
                                                                @foreach ($items as $cate)
                                                                    <option value={{ $cate->id }}>{{ $cate->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                            
                                                        <div class="mb-3 d-flex flex-column">
                                                            <label class="col-form-label d-flex">Room: </label>
                                                            <select  name="room_id" class="p-2 rounded-2">
                                                                @foreach ($rooms as $cate)
                                                                    <option value={{ $cate->id }}>{{ $cate->building }}-{{ $cate->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 d-flex flex-column">
                                                            <label class="col-form-label d-flex text-right">User:</label>
                                                            <select name="employee_id" class="p-2 rounded-2">
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{ $employee->id }}">{{ $employee->firstname }}
                                                                        {{ $employee->lastname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 d-flex flex-column">
                                                            <label class="col-form-label d-flex text-right">Status:</label>
                                                            <select name="status" class="p-2 rounded-2">
                                                                @foreach ($statuses as $stat)
                                                                    <option value="{{ $stat->id }}">{{ $stat->status }}
                                                                        </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"><i class="bx bx-log-out-circle"></i>
                                                            Cancel</button>
                                                        <button type="submit" class="btn btn-primary ml-3"><i
                                                                class="bx bx-save"></i>Confirm</button>
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
        {!! $transactions->links() !!}
    </div>
    {{-- create transaction pop up --}}
    <div class="modal fade" id="addNewTransaction" tabindex="-1" aria-labelledby="TransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buildingModalLabel">Create Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 d-flex flex-column">
                                <label class="col-form-label d-flex">Item:</label>
                                <select name="item_id" class="p-2 rounded-2">
                                    @foreach ($items as $cate)
                                        <option value={{ $cate->id }}>{{ $cate->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 d-flex flex-column">
                                <label class="col-form-label d-flex">Room: </label>
                                <select  name="room_id" class="p-2 rounded-2">
                                    @foreach ($rooms as $cate)
                                        <option value={{ $cate->id }}>{{ $cate->building }}-{{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label class="col-form-label d-flex text-right">User:</label>
                                <select name="employee_id" class="p-2 rounded-2">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->firstname }}
                                            {{ $employee->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label class="col-form-label d-flex text-right">Status:</label>
                                <select name="status" class="p-2 rounded-2">
                                    @foreach ($statuses as $stat)
                                        <option value="{{ $stat->id }}">{{ $stat->status }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                        class="bx bx-log-out-circle"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary ml-3"><i
                                        class="bx bx-save"></i>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


@endsection
