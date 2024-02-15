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
        return view('admin.departments.index', ['departments' => $departments]);
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

        // Validate unique code before storing
        $request->validate([
            'name' => 'unique:departments,name,',
        ]);

        $department->name = $request->name;
        $department->save();
        $departmentCreatedMessage = '';

        if ($department->wasRecentlyCreated) {
            $departmentCreatedMessage = $department->name . trans('app.department_created_succesfully');
        } else {
            $departmentCreatedMessage = trans('app.department_created_error');
        }
        $departments = Department::all();
        return redirect()->route('admin.departments.index', ['departments' => $departments])->with('message', $departmentCreatedMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $users = $department->users()->orderBy('surname')
            ->orderBy('name')
            ->orderBy('email')
            ->orderBy('phone_Number1')->paginate(config('app.pagination.default'));
        return view('admin.departments.show', compact('department', 'users'));
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
        $request->validate([
            'name' => 'unique:departments,name,',
        ]);
        // Guarda los valores actuales antes de la actualización
        $previousValues = $department->getAttributes();

        $department->name = $request->name;
        $department->save();
        // Obtiene los valores después de la actualización
        $currentValues = $department->fresh()->getAttributes();

        $departmentUpdatedMessage = '';
        // Compara los valores antes y después para determinar si hubo cambios
        $changesDetected = array_diff_assoc($currentValues, $previousValues);

        if (!empty($changesDetected)) {
            // El registro fue actualizado recientemente
            $departmentUpdatedMessage = trans('app.department_updated_succesfully');
        } else if (empty($changesDetected)) {
            $departmentUpdatedMessage = trans('app.department_updated_noChanges') . $department->name;
        } else {
            // El registro no ha sido actualizado
            $departmentUpdatedMessage = trans('app.department_updated_error');
        }
        $departments = Department::all();
        return redirect()->route('admin.departments.index', ['departments' => $departments])->with('message', $departmentUpdatedMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $departmentName = $department->name;
        $department->delete();
        $departmentDeletedMessage = '';

        if (!$department->exists) {
            // El registro ya no existe en la base de datos
            $departmentDeletedMessage = $departmentName . trans('app.department_deleted_succesfully');
        } else {
            // El registro fue eliminado recientemente
            $departmentDeletedMessage = trans('app.department_deleted_error');
        }

        $departments = Department::all();
        return redirect()->route('admin.departments.index', ['departments' => $departments])->with('message', $departmentDeletedMessage);
    }
}
