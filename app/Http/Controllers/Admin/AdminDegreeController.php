<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Degree;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminDegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degrees = Degree::all();
        return view('admin.degrees.index', ['degrees' => $degrees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.degrees.create_edit', ['departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $degree = new Degree();
        $degree->name = $request->name;
        $degree->department_id = $request->department_id;
        $degree->save();

        $degrees = Degree::all();
        return redirect()->route('admin.degrees.index', ['degrees' => $degrees]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Degree $degree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Degree $degree)
    {
        $departments = Department::all();
        return view('admin.degrees.create_edit', ['degree' => $degree, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Degree $degree)
    {
        $degree->name = $request->name;
        $degree->department_id = $request->department_id;
        $degree->save();

        $degrees = Degree::all();
        return redirect()->route('admin.degrees.index', ['degrees' => $degrees]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();

        $degrees = Degree::all();
        return view('admin.degrees.index', ['degrees' => $degrees]);
    }
}
