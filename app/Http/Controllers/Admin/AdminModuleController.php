<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Module;
use App\Models\Degree;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', ['modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $degrees = Degree::all();
        return view('admin.modules.create_edit', ['degrees' => $degrees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $module = new Module();
        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->code = $request->code;
        $module->save();
        $module->degrees()->attach($request->input('degrees', []));
        $modules = Module::all();
        return view('admin.modules.index', ['modules' => $modules]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        $degrees = Degree::all();
        return view('admin.modules.create_edit', ['module' => $module, 'degrees' => $degrees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->code = $request->code;
        //Le actualizamos los ciclos donde se da
        $module->degrees()->sync($request->input('degrees', []));
        $module->save();
        $modules = Module::all();
        return view('admin.modules.index', ['modules' => $modules]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();

        $modules = Module::all();
        return view('admin.modules.index', ['modules' => $modules]);
    }
}
