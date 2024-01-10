@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2">{{ $degree->name }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="mb-3">
                                <label for="department_id" class="form-label">{{ trans('app.department') }}</label>
                                <div class="border rounded p-2">
                                    <span>{{ $degree->department->name }}</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="modules" class="form-label">{{ trans('app.modules') }}</label>
                                <div class="card p-3">
                                    <div class="row">
                                        @foreach ($degree->modules as $module)
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="modules[]" id="modules[]" value="{{ $module->id }}"
                                                                @if (isset($degree) && $degree->modules->contains('name', $module->name))
                                                                    checked
                                                                @endif
                                                                disabled>
                                                            {{ $module->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId) {
            var deleteConfirmation = "{{ trans('app.delete_degree') }}";
            if (confirm(deleteConfirmation)) {
                document.getElementById(formId).submit();
            }
        }
    </script>
    @if (session('message'))
        <script>
            function showPopUp() {
                alert('{{ session('message') }}');
            }
            window.onload = showPopUp;
        </script>
    @endif
@endsection
