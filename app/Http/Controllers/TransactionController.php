<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Room;
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
        $transactions = DB::table('transactions')
                    ->join('items','transactions.item_id','=','items.id')
                    ->join('employees','transactions.employee_id','=','employees.id')
                    ->join('rooms','transactions.room_id','=','rooms.id')
                    ->select('transactions.id','transactions.created_at','items.title','items.status','employees.firstname','employees.lastname','rooms.building_id','rooms.name')
                    ->paginate(10);
        return view('Transaction.index',compact('transactions'));
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
        return view('Transaction.create')->with(compact('rooms'))->with(compact('items'))->with(compact('employees'));
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
        $request->validate([
            'item_id'=>'required',
            'room_id'=>'required',
            'employee_id'=>'required',

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
                    ->join('buildings','rooms.building_id','=','buildings.id')
                    ->select('buildings.building','rooms.name','rooms.id')
                    ->get();
        $items = Item::orderBy('id','desc')->paginate(0);
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

        return redirect()->route('transactions.index')->with('success','Transaction Has Been updated successfully');
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
        return redirect()->route('transactions.index')->with('success','Transaction Has Been removed successfully');
    }
}
