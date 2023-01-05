<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeImage;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $employees = Employee::where([
            ['lastname','!=',Null],
            [function($query) use ($request){
                if($term = $request->term){
                    $query->orWhere('lastname','LIKE','%'.$term.'%')
                    ->orWhere('firstname','like','%'.$term.'%')
                    ->get();
                }
            }]
        ])->orderBy('id','desc')->paginate(10);
        $count=DB::table('employees')->count();
        return view('Employee.index')->with(compact('employees'))->with(compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Employee.create');
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
        // Employee::create($request->post()); 
        $employee = new Employee();
        $employee['firstname'] = $request->firstname;
        $employee['lastname'] = $request->lastname;
        $employee['gender'] = $request->gender;
        $employee['email'] = $request->email;
        $employee['phone_number'] = $request->phone_number;

        $employee->save();


        $data = new EmployeeImage();

        if($request->file('images')){
            $file= $request->file('images');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['url']= $filename;
        }
        $data['employee_id'] = $employee->id;
        $data->save();

        return redirect()->route('employees.index')->with('success','Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        return view('Employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $employee->fill($request->post())->save();

        return redirect()->route('employees.index')->with('success','Employee Has Been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee Has Been removed successfully');
    }
}
