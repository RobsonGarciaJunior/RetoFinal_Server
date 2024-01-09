<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Module;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('id', \App\Models\Role::IS_STUDENT);
        });
        $personnel = User::whereHas('roles', function ($query) {
            $query->where('id', \App\Models\Role::IS_PROFESSOR);
        });
        $noRole = User::whereHas('roles', function ($query) {
            $query->where('id', \App\Models\Role::NO_ROLE);
        });
        $departments = Department::count();
        $degrees = Degree::count();
        $modules = Module::count();
        return view('admin/home',['students' => $students, 'personnel' => $personnel,'noRole' => $noRole,'departments' => $departments,'degrees' => $degrees, 'modules' => $modules]);
    }
    
}
