<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Status;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $categories = Category::orderBy('id','desc')->paginate(0);
        // $items = Item::orderBy('id','desc')->paginate(5);
        $items = DB::table('items')
                ->join('categories','items.category_id','=','categories.id')
                ->join('statuses','items.status','=','statuses.id')
                ->join('sponsors','items.sponsored','=','sponsors.id')
                ->where(function($query)use($request){
                    if($term =$request->term){
                        $query->orWhere('items.title','like','%'.$term.'%')
                            ->orWhere('categories.category','like','%'.$term.'%');
                    }
                })
                ->select('items.id','items.title','items.price','statuses.status','sponsors.name','categories.category')
                ->orderBy('id','desc')->paginate(5);

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
        $status = Status::orderBy('id','desc')->paginate(0);
        $sponsor = Sponsor::orderBy('id','desc')->paginate(0);
        return view('Item.create')->with(compact('categories'))->with(compact('status'))->with(compact('sponsor'));
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
        $status = Status::orderBy('id','desc')->paginate(0);
        $sponsor = Sponsor::orderBy('id','desc')->paginate(0);
        return view('Item.edit')->with(compact('categories'))->with(compact('status'))->with(compact('sponsor'))->with(compact('item'));
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
