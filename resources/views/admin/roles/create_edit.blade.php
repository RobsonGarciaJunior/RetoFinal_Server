<div class="container">
    <div class="row">
        <div class="card-body">
            <form class="mt-2" name="create_platform"
                @if (isset($role)) action="{{ route('admin.roles.update', $role) }}"
                            @else
                            action="{{ route('admin.roles.store') }}" @endif
                method="POST" enctype="multipart/form-data">

                @csrf
                @if (isset($role))
                    @method('PUT')
                @endif
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ isset($role) ? $role->name : '' }}" />
                </div>
                <div class="form-group mb-1 text-center">
                    @if (isset($role))
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
