@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"> {{ trans('app.module_list') }}</h4>
                            <button onclick="confirmCreate('{{ route('admin.modules.create') }}')" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </button>

                        </div>
                    </div>
                    <div id="alert"> asd asda </div>
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
                                            <!--
                                                                                <a href="{{ route('admin.modules.edit', ['module' => $module]) }}"
                                                                                    class="btn btn-warning">
                                                                                    <i class="bi bi-pencil-square"></i>
                                                                                </a>
                                                                                -->
                                            <button data-path="{{ route('admin.modules.edit', ['module' => $module]) }}"
                                                class="btn btn-warning" type="button"
                                                onclick="confirmEdit('deleteForm_{{ $module->id }}', '{{ route('admin.modules.edit', ['module' => $module]) }}')">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

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
                    <button type="button" class="btn btn-danger" onclick="submitForm()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL CREAR -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="createModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                    <p id="modalRoute"></p> <!-- Display route here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submitCreateForm()">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR -->
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="editModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Form content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" onclick="submitEditForm()">Edit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId) {
            // Set the modal title and body based on your requirements
            var modalTitle = "Delete Confirmation";
            var modalBody = "Are you sure you want to delete this item?";

            // Set the modal title and body
            $('#deleteModal .modal-title').text(modalTitle);
            $('#deleteModal .modal-body').html(modalBody);

            // Show the modal
            $('#deleteModal').modal('show');

            // Set up a click event for the "Save changes" button in the modal
            $('#deleteModal .modal-footer .btn-primary').click(function() {
                document.getElementById(formId).submit();
            });
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

        function submitEditForm() {
            // Assuming your form has an ID of 'editForm'
            var form = document.getElementById('editForm');

            // Perform any additional client-side validation if needed

            // Submit the form using AJAX
            fetch(form.action, {
                    method: form.method,
                    body: new FormData(form)
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the success response as needed
                    console.log(data);

                    // Optionally, close the modal after successful submission
                    $('#editModal').modal('hide');
                })
                .catch(error => {
                    // Handle errors if needed
                    console.error('Error:', error);
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
        /*
                function showModal(event) {
                    console.log("modal opened");
                    $('#editModal').modal('show');
                    event.preventDefault();
                }
        */
        function submitForm() {
            $('#new_group').submit();
        }
    </script>
    @if (session('message'))
        <script>
            //function showPopUp() {
             //   alert('{{ session('message') }}');
            //}
            //window.onload = showPopUp;
            $('#alert').html("{{session('message')}}" );
        </script>
    @endif
@endsection
