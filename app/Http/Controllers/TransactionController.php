<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Room;
use App\Models\Status;
use App\Models\Item;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = DB::table('rooms')
            ->join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->select('buildings.building', 'rooms.name', 'rooms.id')
            ->get();
        $items = Item::orderBy('id', 'desc')->paginate(0);
        $employees = Employee::orderBy('id', 'desc')->paginate(0);

        $transactions = DB::table('transactions')
                    ->join('items','transactions.item_id','=','items.id')
                    ->join('employees','transactions.employee_id','=','employees.id')
                    ->join('rooms','transactions.room_id','=','rooms.id')
                    ->join('statuses','transactions.status','=','statuses.id')
                    ->select('transactions.id','transactions.created_at','items.title','items.status','employees.firstname','employees.lastname','rooms.building_id','rooms.name','statuses.status')
                    ->paginate(10);
        $statuses = Status::orderBy('id','desc')->paginate(0);
        $countBorrow = DB::table('transactions')
                    ->join('statuses','transactions.status','=','statuses.id')
                    ->where('statuses.status','like','Borrow')->count();
        $countReturn = DB::table('transactions')
                    ->join('statuses','transactions.status','=','statuses.id')
                    ->where('statuses.status','like','Return')->count();
        return view('Transaction.index')->with(compact('transactions'))->with(compact('rooms'))->with(compact('items'))->with(compact('employees'))->with(compact('statuses'))->with(compact('countBorrow'))->with(compact('countReturn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rooms = DB::table('rooms')
                    ->join('buildings','rooms.building_id','=','buildings.id')
                    ->select('buildings.building','rooms.name','rooms.id')
                    ->get();
        $items = Item::orderBy('id','desc')->paginate(0);
        $employees = Employee::orderBy('id','desc')->paginate(0);
        $status = Status::orderBy('id','desc')->paginate(0);
        return view('Transaction.create')->with(compact('rooms'))->with(compact('items'))->with(compact('employees'))->with(compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            'item_id' => 'required',
            'room_id' => 'required',
            'employee_id' => 'required',
            'status'=>'required'

        ]);
        Transaction::create($request->post());
        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
        $rooms = DB::table('rooms')
            ->join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->select('buildings.building', 'rooms.name', 'rooms.id')
            ->get();
        $items = Item::orderBy('id', 'desc')->paginate(0);
        // dd($items);
        return view('Transaction.edit')->with(compact('transaction'))->with(compact('rooms'))->with(compact('items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
        $transaction->fill($request->post())->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction Has Been removed successfully');
    }
}
