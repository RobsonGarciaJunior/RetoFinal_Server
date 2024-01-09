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
            <label for="name" class="form-label">{{ trans('app.degrees') }}</label>
            @foreach ($degrees as $degree)
                <div>
                    <label>
                        <input type="checkbox" name="degrees[]" id="degrees[]" value="{{ $degree->id }}"
                            @if (isset($module)) @if ($module->degrees->contains('name', $degree->name))
                                checked @endif
                            @endif>
                        {{ $degree->name }}
                    </label>
                </div>
            @endforeach
        </div>
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
