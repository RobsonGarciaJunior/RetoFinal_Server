@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"> {{ trans('app.role_list') }}</h4>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($roles as $role)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a class="linkAdmin" href="{{ route('admin.roles.show', ['role' => $role->id]) }}">
                                        {{ $role->name }}
                                    </a>
                                    <div>
                                        <form id="deleteForm_{{ $role->id }}"
                                            action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.roles.show', ['role' => $role->id]) }}"
                                                class="btn btn-info">
                                                <i class="bi bi-search"></i>
                                            </a>
                                            <a href="{{ route('admin.roles.edit', ['role' => $role]) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            @can('role_deletable', $role->id)
                                                <button class="btn btn-danger" type="button"
                                                    onclick="confirmDelete('deleteForm_{{ $role->id }}')">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            @endcan
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
            var deleteConfirmation = "{{ trans('app.delete_role') }}";
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
