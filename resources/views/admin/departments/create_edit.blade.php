@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if (isset($department))
                {{ trans('app.edit_department') }}
                @else
                {{ trans('app.create_degree') }}
                @endif
                <form class="mt-2" name="create_platform"
                    @if (isset($department)) action="{{ route('admin.departments.update', $department) }}"
                @else
                action="{{ route('admin.departments.store') }}" @endif
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @if (isset($department))
                        @method('PUT')
                    @endif
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ trans('app.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ isset($department) ? $department->name : '' }}" />
        </div>
        @if (isset($department))
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
