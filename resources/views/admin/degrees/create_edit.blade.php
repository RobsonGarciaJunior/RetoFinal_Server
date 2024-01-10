@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            @if (isset($degree))
                                <h4 class="mt-2">{{ trans('app.edit_degree') }}</h4>
                            @else
                                <h4 class="mt-2">{{ trans('app.create_degree') }}</h4>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mt-2" name="create_platform"
                            @if (isset($degree))
                                action="{{ route('admin.degrees.update', $degree) }}"
                            @else
                                action="{{ route('admin.degrees.store') }}"
                            @endif
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @if (isset($degree))
                                @method('PUT')
                            @endif

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ trans('app.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="{{ isset($degree) ? $degree->name : '' }}" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="department_id" class="form-label">{{ trans('app.department') }}</label>
                                <select class="form-select" name="department_id" id="department_id" required>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if (isset($degree) && $degree->department->name == $department->name)
                                                selected
                                            @endif>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modules" class="form-label">{{ trans('app.modules') }}</label>
                                <div class="card p-3">
                                    <div class="row">
                                        @foreach ($modules as $module)
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="modules[]" id="modules[]" value="{{ $module->id }}"
                                                                @if (isset($degree) && $degree->modules->contains('name', $module->name))
                                                                    checked
                                                                @endif>
                                                            {{ $module->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1 text-center">
                                @if (isset($degree))
                                    <button type="submit" class="btn btn-warning">
                                        {{ trans('app.update') }}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success">
                                        {{ trans('app.create') }}
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
