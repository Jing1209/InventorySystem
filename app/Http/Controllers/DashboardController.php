<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('dashboard');
        $users = Category::select('quantity','category')
                    // ->whereYear('created_at', date('d'))
                    // ->groupBy('category')
                    ->pluck('quantity','category');
                    // ->get();
 
        $labels = $users->keys();
        $data = $users->values();
        // dd($users);
        
       
        
              
        return view('dashboard')->with(compact('labels','data'));
    }
}
