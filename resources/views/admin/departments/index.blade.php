@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ trans('app.department_list') }}</h4>
                            <a href="{{ route('admin.departments.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($departments as $department)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a class="linkAdmin"
                                        href="{{ route('admin.departments.show', ['department' => $department->id]) }}"
                                        style="display: inline;">
                                        {{ $department->name }}
                                    </a>
                                    <div>
                                        <form id="deleteForm_{{ $department->id }}"
                                            action="{{ route('admin.departments.destroy', $department) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div>
                                                <a href="{{ route('admin.departments.show', ['department' => $department->id]) }}"
                                                    class="btn btn-info">
                                                    <i class="bi bi-search"></i>
                                                </a>
                                                <a href="{{ route('admin.departments.edit', ['department' => $department]) }}"
                                                    class="btn btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-danger" type="button"
                                                    onclick="confirmDelete('deleteForm_{{ $department->id }}')">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
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
            var deleteConfirmation = "{{ trans('app.delete_department') }}";
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
