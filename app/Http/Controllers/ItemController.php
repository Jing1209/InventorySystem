<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Status;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ItemImage;

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
                // ->join('itemimages','itemimages.item_id','=','item.id')
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
        // Item::create($request->post());
        $item = new Item();
        $item['title'] = $request->title;
        $item['description'] = $request->description;
        $item['price'] = $request->price;
        $item['status'] = $request->status;
        $item['category_id'] = $request->category_id;
        $item['sponsored'] = $request->sponsored;
        $item->save();

        $quantity = Category::find($request->category_id);
        $quantity->quantity+=1;
        $quantity->save();
        
        $data = new ItemImage();

        if($request->file('images')){
            $file= $request->file('images');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['url']= $filename;
        }
        $data['item_id'] = $item->id;
        $data->save();


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
        $items = DB::table('items')
                ->join('itemimages','items.id','=','itemimages.item_id')
                ->select('items.id','items.title','items.price','items.status')
                ->where('items.id','=',$item->id)
                ->get();
        $image = DB::table('items')
                ->join('itemimages','items.id','=','itemimages.item_id')
                ->select('itemimages.url')
                ->where('itemimages.item_id','=',$item->id)->get();
        $categories = Category::orderBy('id','desc')->paginate(0);
        $status = Status::orderBy('id','desc')->paginate(0);
        $sponsor = Sponsor::orderBy('id','desc')->paginate(0);
        return view('Item.edit')->with(compact('categories'))->with(compact('status'))->with(compact('sponsor'))->with(compact('item'))->with(compact('items'))->with(compact('image'));
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
        // dd($item->id);
        $deleteImage = DB::table('itemimages')->where('item_id','=',$item->id)->delete();
        $item->delete();
        return redirect()->route('items.index')->with('success','Item Has Been removed successfully');
    }
}
