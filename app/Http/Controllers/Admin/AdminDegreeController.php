<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Degree;
use App\Models\Department;
use App\Models\Module;
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
        $modules = Module::all();
        return view('admin.degrees.create_edit', ['departments' => $departments, 'modules' => $modules]);
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
        $degree->modules()->attach($request->input('modules', []));
        $degreeCreatedMessage = '';
        if ($degree->wasRecentlyCreated) {
            $degreeCreatedMessage = $degree->name . trans('app.degree_created_succesfully');
        } else {
            $degreeCreatedMessage = trans('app.degree_created_error');
        }
        $degrees = Degree::all();
        return redirect()->route('admin.degrees.index', ['degrees' => $degrees])->with('message', $degreeCreatedMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Degree $degree)
    {
        return view('admin.degrees.show', ['degree' => $degree]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Degree $degree)
    {
        $departments = Department::all();
        $modules = Module::all();
        return view('admin.degrees.create_edit', ['degree' => $degree, 'departments' => $departments, 'modules' => $modules]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Degree $degree)
    {
        // Guarda los valores actuales antes de la actualización
        $previousValues = $degree->getAttributes();
        $previousModulesQuantity = $degree->modules->count();

        $degree->name = $request->name;
        $degree->department_id = $request->department_id;
        $degree->modules()->sync($request->input('modules', []));
        $degree->save();

        // Obtiene los valores después de la actualización
        $currentValues = $degree->fresh()->getAttributes();
        $currentModulesQuantity = $degree->fresh()->modules->count();
        // Compara los valores antes y después para determinar si hubo cambios
        $changesDetected = array_diff_assoc($currentValues, $previousValues);
        $degreeUpdatedMessage = '';

        if (!empty($changesDetected) || $previousModulesQuantity != $currentModulesQuantity) {
            // El registro fue actualizado recientemente
            $degreeUpdatedMessage = trans('app.degree_updated_succesfully');
        } else if (empty($changesDetected) && $previousModulesQuantity == $currentModulesQuantity) {
            $degreeUpdatedMessage = trans('app.degree_updated_noChanges') . $degree->name;
        } else {
            // El registro no ha sido actualizado
            $degreeUpdatedMessage = trans('app.degree_updated_error');
        }
        $degrees = Degree::all();
        return redirect()->route('admin.degrees.index', ['degrees' => $degrees])->with('message', $degreeUpdatedMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Degree $degree)
    {
        $degreeName = $degree->name;
        $degree->delete();

        $degreeDeletedMessage = '';

        if (!$degree->exists) {
            // El registro ya no existe en la base de datos
            $degreeDeletedMessage = $degreeName . trans('app.degree_deleted_succesfully');
        } else {
            // El registro fue eliminado recientemente
            $degreeDeletedMessage = trans('app.degree_deleted_error');
        }
        $degrees = Degree::all();
        return redirect()->route('admin.degrees.index', ['degrees' => $degrees])->with('message', $degreeDeletedMessage);
    }
}
