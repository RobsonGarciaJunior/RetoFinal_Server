@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 font-weight-bold text-primary text-uppercase" style="letter-spacing: 2px;">{{ trans('app.statistics') }}</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_students') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"> <a href="{{ route('admin.users.index', ['students' => $students]) }}"
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_personnel') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                            <a href="{{ route('admin.users.index', ['personnel' => $personnel]) }}"
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_no_role') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"> <a href="{{ route('admin.users.index', ['noRole' => $noRole]) }}"
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_departments') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                        <a href="{{ route('admin.departments.index')}}"
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_degrees') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"> <a href="{{ route('admin.degrees.index') }}"
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
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                                        {{ trans('app.total_modules') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"> <a href="{{ route('admin.modules.index') }}"
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
