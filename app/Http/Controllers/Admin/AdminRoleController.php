<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $roleCreatedMessage = '';

        if ($role->wasRecentlyCreated) {
            $roleCreatedMessage = $role->name . trans('app.role_created_succesfully');
        } else {
            $roleCreatedMessage = trans('app.role_created_error');
        }
        $roles = Role::all();
        return redirect()->route('admin.roles.index', ['roles' => $roles])->with('message', $roleCreatedMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $users = $role->users()->orderBy('surname')
            ->orderBy('name')
            ->orderBy('email')
            ->orderBy('phone_number1')->paginate(config('app.pagination.default'));
        return view('admin.roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.create_edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Guarda los valores actuales antes de la actualización
        $previousValues = $role->getAttributes();

        $role->name = $request->name;
        $role->save();

        // Obtiene los valores después de la actualización
        $currentValues = $role->fresh()->getAttributes();

        // Compara los valores antes y después para determinar si hubo cambios
        $changesDetected = array_diff_assoc($currentValues, $previousValues);

        $roleUpdatedMessage = '';

        if (!empty($changesDetected)) {
            // El registro fue actualizado recientemente
            $roleUpdatedMessage = trans('app.role_updated_succesfully');
        } else if (empty($changesDetected)) {
            $roleUpdatedMessage = trans('app.role_updated_noChanges') . $role->name;
        } else {
            // El registro no ha sido actualizado
            $roleUpdatedMessage = trans('app.role_updated_error');
        }
        $roles = Role::all();
        //LO HAGO PARA QUE NO DE PROBLEMAS AL RECARGAR EL FORM(SI QUIERES ENSEÑAR A RUBEN EL PORQUE PON RETURN VIEW Y DPS DE ACTUALIZAR INTENTA REFRESCAR EL INDEX.)
        return redirect()->route('admin.roles.index', ['roles' => $roles])->with('message', $roleUpdatedMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('role_deletable', $role->id);

        $roleName = $role->name;
        $role->delete();
        $roleDeletedMessage = '';

        if (!$role->exists) {
            // El registro ya no existe en la base de datos
            $roleDeletedMessage = $roleName . trans('app.role_deleted_succesfully');
        } else {
            // El registro fue eliminado recientemente
            $roleDeletedMessage = trans('app.role_deleted_error');
        }

        $roles = Role::all();
        return redirect()->route('admin.roles.index', ['roles' => $roles])->with('message', $roleDeletedMessage);
    }
}
