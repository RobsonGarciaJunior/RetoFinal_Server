@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if (isset($degree))
                    {{ trans('app.edit_degree') }}
                @else
                    {{ trans('app.create_degree') }}
                @endif
                <form class="mt-2" name="create_platform"
                    @if (isset($degree)) action="{{ route('admin.degrees.update', $degree) }}"
                @else
                action="{{ route('admin.degrees.store') }}" @endif
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @if (isset($degree))
                        @method('PUT')
                    @endif
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ isset($degree) ? $degree->name : '' }}" />
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.department') }}</label>
            <select class="form-select" name="department_id" id="department_id" required>
                @foreach ($departments as $department)
                    <!-- Comprobamos que el ciclo no sea nulo para saber si estamos en editar o crear -->
                    <!-- Luego si no es nulo, significa que estamos en editar y hay que hacer otra comprobacion para saber que departamento hemos pasado a la vista -->
                    <option value="{{ $department->id }}"
                        @if (isset($degree)) @if ($degree->department->name == $department->name)
                            selected @endif
                        @endif>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-group mb-3">
                <label for="name" class="form-label">{{ trans('app.modules') }}</label>
                @foreach ($modules as $module)
                    <div>
                        <label>
                            <input type="checkbox" name="modules[]" id="modules[]" value="{{ $module->id }}"
                                @if (isset($degree)) @if ($degree->modules->contains('name', $module->name))
                                    checked @endif
                                @endif>
                            {{ $module->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @if (isset($degree))
            <button type="submit" class="btn btn-primary">
                {{ trans('app.update') }}
            </button>
        @else
            <button type="submit" class="btn btn-success">
                {{ trans('app.create') }}
            </button>
        @endif
    </div>
@endsection
