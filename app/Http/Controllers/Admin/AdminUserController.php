<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('archive')) {
            $usersPaginated = User::with('department')->when($request->has('archive'), function ($query) {
                return $query->onlyTrashed();
            })->orderBy('surname')
                ->orderBy('name')
                ->orderBy('email')
                ->orderBy('phone_Number1')
                ->paginate(config('app.pagination.default'));
        } else if ($request->has('students')) {
            $usersPaginated = User::whereHas('roles', function ($query) {
                $query->where('id', 3);
            })
                ->orderBy('surname')
                ->orderBy('name')
                ->orderBy('email')
                ->orderBy('phone_Number1')
                ->paginate(config('app.pagination.default'));
        } else if ($request->has('personnel')) {
            $usersPaginated = User::whereHas('roles', function ($query) {
                $query->where('id', 2);
            })
                ->orderBy('surname')
                ->orderBy('name')
                ->orderBy('email')
                ->orderBy('phone_Number1')
                ->paginate(config('app.pagination.default'));
        } elseif ($request->has('noRole')) {
            $usersPaginated = User::whereDoesntHave('roles')
                ->orderBy('surname')
                ->orderBy('name')
                ->orderBy('email')
                ->orderBy('phone_Number1')
                ->paginate(config('app.pagination.default'));
        } else {
            $usersPaginated = User::orderBy('surname')
                ->orderBy('name')
                ->orderBy('email')
                ->orderBy('phone_Number1')
                ->paginate(config('app.pagination.default'));
        }

        $trashedCount = User::onlyTrashed()->count();
        return view('admin.users.index', compact('usersPaginated', 'trashedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('admin.users.create_edit', ['roles' => $roles, 'departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'phone_number1' => 'max:9|unique:users,phone_number1,',
            'phone_number2' => 'max:9|unique:users,phone_number2,',
        ]);

        $user = new User();
        $user->DNI = $request->DNI;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone_Number1 = $request->phoneNumber1;
        $user->phone_Number2 = $request->phoneNumber2;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make('elorrieta00');
        $user->department_id = $request->department_id;
        $user->save();
        $user->roles()->attach($request->input('roles', []));

        $userCreatedMessage = '';

        if ($user->wasRecentlyCreated) {
            $userCreatedMessage = $user->name . trans('app.user_created_succesfully');
        } else {
            $userCreatedMessage = trans('app.user_created_error');
        }

        return redirect()->route('admin.users.index')->with('message', $userCreatedMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('admin.users.create_edit', ['user' => $user, 'roles' => $roles, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'phone_number1' => 'max:9|unique:users,phone_number1,' . $user->id,
            'phone_number2' => 'max:9|unique:users,phone_number2,' . $user->id,
        ]);

        // Guarda los valores actuales antes de la actualización
        $previousValues = $user->getAttributes();
        $previousRolesQuantity = $user->roles->count();

        $user->name = $request->name;
        $user->DNI = $request->DNI;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone_Number1 = $request->phoneNumber1;
        $user->phone_Number2 = $request->phoneNumber2;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->roles()->sync($request->input('roles', []));
        $user->save();
        // Obtiene los valores después de la actualización
        $currentValues = $user->fresh()->getAttributes();
        $currentRolesQuantity = $user->fresh()->roles->count();
        // Compara los valores antes y después para determinar si hubo cambios
        $changesDetected = array_diff_assoc($currentValues, $previousValues);
        $userUpdatedMessage = '';
        if (!empty($changesDetected) || $previousRolesQuantity != $currentRolesQuantity) {
            // El registro fue actualizado recientemente
            $userUpdatedMessage = trans('app.user_updated_succesfully');
        } else if (empty($changesDetected) && $previousRolesQuantity == $currentRolesQuantity) {
            $userUpdatedMessage = trans('app.user_updated_noChanges') . $user->name;
        } else {
            // El registro no ha sido actualizado
            $userUpdatedMessage = trans('app.user_updated_error');
        }
        return redirect()->route('admin.users.index')->with('message', $userUpdatedMessage);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('admin.users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('user_deletable', $user);
        $userName = $user->name;
        $user->delete();
        $userDeletedMessage = '';

        if ($user->trashed()) {
            // El registro ya no existe en la base de datos
            $userDeletedMessage = $userName . trans('app.user_soft_deleted_successfully');
        } else {
            // El registro fue eliminado recientemente
            $userDeletedMessage = trans('app.user_soft_deleted_error');
        }
        return redirect()->route('admin.users.index')->with('message', $userDeletedMessage);
    }
}
