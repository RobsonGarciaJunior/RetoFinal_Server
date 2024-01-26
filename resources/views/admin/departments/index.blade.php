@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ trans('app.department_list') }}</h4>
                            <button onclick="confirmCreate('{{ route('admin.departments.create') }}')"
                                class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                                                <button class="btn btn-warning" type="button"
                                                    onclick="confirmEdit('deleteForm_{{ $department->id }}', '{{ route('admin.departments.edit', ['department' => $department]) }}')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
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
    <!-- MODAL BORRAR -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="submitForm()">{{ trans('app.delete') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CREAR -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="createModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mt-2"> {{ trans('app.create_department') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                    <p id="modalRoute"></p> <!-- Display route here -->
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="editModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mt-2">{{ trans('app.edit_department') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Form content will be loaded here -->
                </div>
            </div>
        </div>

        <script>
            function confirmDelete(formId) {
                // Set the modal title and body based on your requirements
                var modalTitle = "{{ trans('app.delete_department') }}";
                var modalBody = "{{ trans('app.delete_department_ask') }}";

                // Set the modal title and body
                $('#deleteModal .modal-title').text(modalTitle);
                $('#deleteModal .modal-body').html(modalBody);

                // Show the modal
                $('#deleteModal').modal('show');

                // Set up a click event for the "Save changes" button in the modal
                $('#deleteModal .modal-footer .btn-danger').click(function() {
                    document.getElementById(formId).submit();
                });
            }

            function submitForm() {
                $('#new_group').submit();
            }

            function confirmEdit(formId, route) {
                // Set the modal title and body based on your requirements
                var modalTitle = "Edit Form";
                var modalBody = "Loading form...";

                // Set the modal title and body
                $('#editModal .modal-title').text(modalTitle);
                $('#editModal .modal-body').html(modalBody);

                // Use AJAX to fetch the form content from the specified route
                $.ajax({
                    type: 'GET',
                    url: route,
                    success: function(response) {
                        // Replace the modal body with the fetched form content
                        $('#editModal .modal-body').html(response);

                        // Set a specific ID for the form inside the modal
                        $('#editModal form').attr('id', 'editForm');

                        // Show the modal
                        $('#editModal').modal('show');
                    },
                    error: function() {
                        // Handle errors if needed
                        $('#editModal .modal-body').html("Failed to load form content.");
                        $('#editModal').modal('show');
                    }
                });
            }

            function confirmCreate(route) {
                // Set the modal title and body based on your requirements
                var modalTitle = "Create Form";
                var modalBody = "Loading form...";

                // Set the modal title and body
                $('#createModal .modal-title').text(modalTitle);
                $('#createModal .modal-body').html(modalBody);

                // Use AJAX to fetch the form content from the specified route
                $.ajax({
                    type: 'GET',
                    url: route,
                    success: function(response) {
                        // Replace the modal body with the fetched form content
                        $('#createModal .modal-body').html(response);

                        // Show the modal
                        $('#createModal').modal('show');
                    },
                    error: function() {
                        // Handle errors if needed
                        $('#createModal .modal-body').html("Failed to load form content.");
                        $('#createModal').modal('show');
                    }
                });
            }
        </script>

        <script>
            // Using JavaScript
            //document.getElementById("alert").style.display = "none";

            // Using jQuery
            $("#alert").hide();
        </script>

        @if (session('message'))
            <script>
                $(document).ready(function() {
                    // Display the alert with the session message
                    $('#alert').show().html("{{ session('message') }}");

                    // Set a timeout to hide the alert after a specific duration (e.g., 5000 milliseconds or 5 seconds)
                    setTimeout(function() {
                        $('#alert').hide();
                    }, 1000); // Adjust the duration as needed
                });
            </script>
        @endif
    @endsection
