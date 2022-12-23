<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $categories = Category::orderBy('id','desc')->paginate(0);
        // $items = Item::orderBy('id','desc')->paginate(5);
        $items = DB::table('items')->join('categories','items.category_id','=','categories.id')->select('items.id','items.title','items.price','items.status','categories.category')->get();
        return view('Item.index')->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::orderBy('id','desc')->paginate(0);
        return view('Item.create')->with(compact('categories'));
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
        // $request ->validate([

        // ]);
        Item::create($request->post());
        $quantity = Category::find($request->category_id);
        $quantity->quantity+=1;
        $quantity->save();

        return redirect()->route('items.index')->with('success','Item has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        // $items = DB::table('items')->join('categories','items.category_id','=','categories.id')->select('items.id','items.title','items.price','items.status','categories.category')->get();
        $categories = Category::orderBy('id','desc')->paginate(0);
        return view('Item.edit')->with(compact('item'))->with(compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        $item->fill($request->post())->save();

        return redirect()->route('items.index')->with('success','Item Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item->delete();
        return redirect()->route('items.index')->with('success','Item Has Been removed successfully');
    }
}
