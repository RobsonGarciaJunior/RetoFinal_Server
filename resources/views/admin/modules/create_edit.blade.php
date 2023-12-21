@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if (isset($module))
                    {{ trans('app.edit_module') }}
                @else
                    {{ trans('app.create_module') }}
                @endif
                <form class="mt-2" name="create_platform"
                    @if (isset($module)) action="{{ route('admin.modules.update', $module) }}"
                @else
                action="{{ route('admin.modules.store') }}" @endif
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @if (isset($module))
                        @method('PUT')
                    @endif
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ isset($module) ? $module->name : '' }}" />
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.hours') }}</label>
            <input type="number" class="form-control" id="hours" name="hours" required
                value="{{ isset($module) ? $module->hours : '' }}" />
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.code') }}</label>
            <input type="number" class="form-control" id="code" name="code" required
                value="{{ isset($module) ? $module->code : '' }}" />
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.degree') }}</label>
            <select class="form-select" name="degree_id" id="degree_id" required>
                @foreach ($degrees as $degree)
                    <!-- Comprobamos que el ciclo no sea nulo para saber si estamos en editar o crear -->
                    <!-- Luego si no es nulo, significa que estamos en editar y hay que hacer otra comprobacion para saber que departamento hemos pasado a la vista -->
                    <option value="{{ $degree->id }}"
                        @if (isset($module)) @if ($module->degrees->first()->name == $degree->name)
                            selected @endif
                        @endif>
                        {{ $degree->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if (isset($module))
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
