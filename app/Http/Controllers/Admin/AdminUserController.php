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
        $usersPaginated = User::with('department')->when($request->has('archive'), function ($query) {
            return $query->onlyTrashed();
        })->orderBy('surname')
            ->orderBy('name')
            ->orderBy('email')
            ->orderBy('phoneNumber1')
            ->paginate(config('app.pagination.default'));

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
        $user = new User();
        $user->DNI = $request->DNI;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phoneNumber1 = $request->phoneNumber1;
        $user->phoneNumber2 = $request->phoneNumber2;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make('elorrieta00');
        $user->department_id = $request->department_id;
        $user->save();
        $user->roles()->attach($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
        $user->name = $request->name;
        $user->DNI = $request->DNI;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phoneNumber1 = $request->phoneNumber1;
        $user->phoneNumber2 = $request->phoneNumber2;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->roles()->sync($request->input('roles', []));
        $user->save();
        return redirect()->route('admin.users.index');
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
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
