@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="align-items-center mb-4">
            <h3 class="h3 mt-3 font-weight-bold text-uppercase text-center adminText" style="letter-spacing: 2px;">
                {{ trans('app.elorrieta_users') }}</h3>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a class="linkAdmin"
                            href="{{ route('admin.users.index', ['archive' => 1]) }}">{{ trans('app.archived') }}</a>
                        <a>({{ $trashedCount }})</a>
                    </div>
                    <div class="ml-auto">
                        <button onclick="confirmCreate('{{ route('admin.users.create') }}')" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('app.name') }}</th>
                        <th>{{ trans('app.surname') }}</th>
                        <th>{{ trans('app.email') }}</th>
                        <th>{{ trans('app.phone') }}</th>
                        <th>{{ trans('app.roles') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usersPaginated as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number1 }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                    @if (!$loop->last)
                                        {{-- Agrega una coma si no es el último rol --}}
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if ($user->trashed())
                                    <form id="restoreForm_{{ $user->id }}"
                                        action="{{ route('admin.users.restore', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-primary" type="button"
                                            onclick="confirmRestore('restoreForm_{{ $user->id }}')">
                                            {{ trans('app.restore') }}
                                        </button>
                                    </form>
                                    <form id="deleteForm_{{ $user->id }}"
                                        action="{{ route('admin.users.force_delete', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-danger" type="button"
                                            onclick="confirmDelete('deleteForm_{{ $user->id }}')">
                                            {{ trans('app.delete_forever') }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.users.show', ['user' => $user->id]) }}" class="btn btn-info">
                                        <i class="bi bi-search"></i>
                                    </a>
                                    <button class="btn btn-warning" type="button"
                                        onclick="confirmEdit('deleteForm_{{ $user->id }}', '{{ route('admin.users.edit', ['user' => $user]) }}')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form id="sendToTrashForm_{{ $user->id }}"
                                        action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        @can('user_deletable', $user)
                                            <button class="btn btn-danger" type="button"
                                                onclick="confirmSendingToTrash('sendToTrashForm_{{ $user->id }}')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        @endcan
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">{{ trans('app.no_user') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div id='pagination' class="text-right">
            {{ $usersPaginated->links('pagination::bootstrap-4') }}
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
    <!-- MODAL TRASH -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="sendToTrashModal">
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
                    <button type="button" class="btn btn-danger"
                        onclick="submitForm()">{{ trans('app.archive') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL RESTORE -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="restoreModal">
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
                    <button type="button" class="btn btn-primary"
                        onclick="submitForm()">{{ trans('app.restore') }}</button>
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
                    <h4 class="mt-2"> {{ trans('app.create_user') }}</h4>
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
                    <h4 class="mt-2">{{ trans('app.edit_user') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Form content will be loaded here -->
                </div>
            </div>
        </div>
        <script>
            function confirmSendingToTrash(formId) {
                // Set the modal title and body based on your requirements
                var modalTitle = "{{ trans('app.sendToTrash_user') }}";
                var modalBody = "{{ trans('app.sendToTrash_user_ask') }}";

                // Set the modal title and body
                $('#sendToTrashModal .modal-title').text(modalTitle);
                $('#sendToTrashModal .modal-body').html(modalBody);

                // Show the modal
                $('#sendToTrashModal').modal('show');

                // Set up a click event for the "Save changes" button in the modal
                $('#sendToTrashModal .modal-footer .btn-danger').click(function() {
                    document.getElementById(formId).submit();
                });
            }

            function confirmRestore(formId) {
                // Set the modal title and body based on your requirements
                var modalTitle = "{{ trans('app.restore_user') }}";
                var modalBody = "{{ trans('app.restore_user_ask') }}";

                // Set the modal title and body
                $('#restoreModal .modal-title').text(modalTitle);
                $('#restoreModal .modal-body').html(modalBody);

                // Show the modal
                $('#restoreModal').modal('show');

                // Set up a click event for the "Save changes" button in the modal
                $('#restoreModal .modal-footer .btn-primary').click(function() {
                    document.getElementById(formId).submit();
                });
            }

            function confirmDelete(formId) {
                // Set the modal title and body based on your requirements
                var modalTitle = "{{ trans('app.delete_user') }}";
                var modalBody = "{{ trans('app.delete_user_ask') }}";

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
