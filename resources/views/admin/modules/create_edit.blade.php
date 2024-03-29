<div class="container">
    <div class="row">
        <div class="card-body">
            <form class="mt-2" name="create_platform"
                @if (isset($module)) action="{{ route('admin.modules.update', $module) }}"
                        @else
                        action="{{ route('admin.modules.store') }}" @endif
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($module))
                    @method('PUT')
                @endif
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ isset($module) ? $module->name : '' }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.hours') }}</label>
                    <input type="number" class="form-control" id="hours" name="hours" required
                        value="{{ isset($module) ? $module->hours : '' }}" min="1" />
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.code') }}</label>
                    <input type="number" class="form-control" id="code" name="code" required
                        value="{{ isset($module) ? $module->code : '' }}" min="1" />
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.degrees') }}</label>
                    <div class="card p-3">
                        <div class="row">
                            @foreach ($degrees as $degree)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="degrees[]" id="degrees[]"
                                                    value="{{ $degree->id }}"
                                                    @if (isset($module)) @if ($module->degrees->contains('name', $degree->name))
                                                            checked @endif
                                                    @endif>
                                                {{ $degree->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group mb-1 text-center">
                    @if (isset($module))
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
