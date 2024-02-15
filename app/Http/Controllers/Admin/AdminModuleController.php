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

        $request->validate([
            'code' => 'required|unique:modules,code',
            'name' => 'required|unique:modules,name',
            'hours' => 'required|numeric|min:0',
        ]);

        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->code = $request->code;
        $module->save();
        $module->degrees()->attach($request->input('degrees', []));
        $moduleCreatedMessage = '';

        if ($module->wasRecentlyCreated) {
            $moduleCreatedMessage = $module->name . trans('app.module_created_succesfully');
        } else {
            $moduleCreatedMessage = trans('app.module_created_error');
        }
        $modules = Module::all();
        return redirect()->route('admin.modules.index', ['modules' => $modules])->with('message', $moduleCreatedMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.modules.show', ['module' => $module]);
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
        // Validate unique code before updating
        $request->validate([
            'code' => 'unique:modules,code,',
        ]);

        // Guarda los valores actuales antes de la actualización
        $previousValues = $module->getAttributes();
        $previousDegreesQuantity = $module->degrees->count();

        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->code = $request->code;
        //Le actualizamos los ciclos donde se da
        $module->degrees()->sync($request->input('degrees', []));
        $module->save();

        // Obtiene los valores después de la actualizacióna
        $currentValues = $module->fresh()->getAttributes();
        $currentDegreesQuantity = $module->fresh()->degrees->count();
        // Compara los valores antes y después para determinar si hubo cambios
        $changesDetected = array_diff_assoc($currentValues, $previousValues);
        $moduleUpdatedMessage = '';

        if (!empty($changesDetected) || $previousDegreesQuantity != $currentDegreesQuantity) {
            // El registro fue actualizado recientemente
            $moduleUpdatedMessage = trans('app.module_updated_succesfully');
        } else if (empty($changesDetected) && $previousDegreesQuantity == $currentDegreesQuantity) {
            $moduleUpdatedMessage = trans('app.module_updated_noChanges') . $module->name;
        } else {
            // El registro no ha sido actualizado
            $moduleUpdatedMessage = trans('app.module_updated_error');
        }
        $modules = Module::all();
        return redirect()->route('admin.modules.index', ['modules' => $modules])->with('message', $moduleUpdatedMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $moduleName = $module->name;
        $module->delete();
        $moduleDeletedMessage = '';

        if (!$module->exists) {
            // El registro ya no existe en la base de datos
            $moduleDeletedMessage = $moduleName . trans('app.degree_deleted_succesfully');
        } else {
            // El registro fue eliminado recientemente
            $moduleDeletedMessage = trans('app.degree_deleted_error');
        }
        $modules = Module::all();
        return redirect()->route('admin.modules.index', ['modules' => $modules])->with('message', $moduleDeletedMessage);
    }
}
