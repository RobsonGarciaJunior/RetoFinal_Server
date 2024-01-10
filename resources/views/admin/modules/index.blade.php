@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"> {{ trans('app.module_list') }}</h4>
                            <a href="{{ route('admin.modules.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($modules as $module)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a class="linkAdmin" href="{{ route('admin.modules.show', ['module' => $module->id]) }}"
                                        style="display: inline;">
                                        {{ $module->name }}
                                    </a>
                                    <div>
                                        <form id="deleteForm_{{ $module->id }}"
                                            action="{{ route('admin.modules.destroy', $module) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.modules.show', ['module' => $module->id]) }}"
                                                class="btn btn-info">
                                                <i class="bi bi-search"></i>
                                            </a>
                                            <a href="{{ route('admin.modules.edit', ['module' => $module]) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button"
                                                onclick="confirmDelete('deleteForm_{{ $module->id }}')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(formId) {
            var deleteConfirmation = "{{ trans('app.delete_module') }}";
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
