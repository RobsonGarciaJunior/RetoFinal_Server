@extends('layouts.admin')

@section('content')

<button id="darkModeToggle">Cambiar Modo</button>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="align-items-center mb-4">
                <h1 class="h3 mt-3 font-weight-bold text-uppercase text-center adminText" style="letter-spacing: 2px;">{{ trans('app.statistics') }}</h1>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 mb-4 ">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_students') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                            <a class="linkAdmin" href="{{ route('admin.users.index', ['students' => 1]) }}"
                                            style="display: inline;">{{$students->count()}}
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_personnel') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                            <a class="linkAdmin" href="{{ route('admin.users.index', ['personnel' => 1]) }}"
                                            style="display: inline;">{{$personnel->count()}}
                                        </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_no_role') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                            <a class="linkAdmin" href="{{ route('admin.users.index', ['noRole' => 1]) }}"
                                            style="display: inline;">{{$noRole->count()}}
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_departments') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                        <a class="linkAdmin" href="{{ route('admin.departments.index')}}"
                                            style="display: inline;">{{$departments}}
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_degrees') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                        <a class="linkAdmin" href="{{ route('admin.degrees.index') }}"
                                        style="display: inline;">{{$degrees}}
                                    </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center adminText">
                                        {{ trans('app.total_modules') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                            <a class="linkAdmin" href="{{ route('admin.modules.index') }}"
                                            style="display: inline;">{{$modules}}
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
