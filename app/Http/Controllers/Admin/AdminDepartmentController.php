<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Department;
use Illuminate\Http\Request;


class AdminDepartmentController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index',['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $department = new Department();
        $department->name = $request->name;
        $department->save();
        return redirect()->route('admin.departments.create_edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.create_edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $department->name = $request->name;
        $department->save();

        $departments = Department::all();
        return view('admin.departments.index',['departments' => $departments]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        $departments = Department::all();
        return view('admin.departments.index', ['departments' => $departments]);
    }
}
