@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mt-2">{{ $module->name }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                         <label for="name" class="form-label">{{ trans('app.hours') }}</label>
                         <div class="border rounded p-2">
                            <span>{{ $module->hours}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">{{ trans('app.code') }}</label>
                        <div class="border rounded p-2">
                            <span>{{ $module->code}}</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">{{ trans('app.degrees') }}</label>
                        <div class="card p-3">
                            <div class="row">
                                @foreach ($module->degrees as $degree)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="degrees[]" id="degrees[]" value="{{ $degree->id }}"
                                                    @if (isset($module)) @if ($module->degrees->contains('name', $degree->name))
                                                        checked @endif
                                                    @endif disabled>
                                                    {{ $degree->name }}
                                                </label>
                                            </div>
                                        </div>
                                     </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection

