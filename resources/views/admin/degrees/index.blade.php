@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ trans('app.degree_list') }}</h4>
                            <a href="{{ route('admin.degrees.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($degrees as $degree)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a class="linkAdmin"
                                        href="{{ route('admin.degrees.show', ['degree' => $degree->id]) }}">
                                        {{ $degree->name }}
                                    </a>
                                    <div>
                                        <form id="deleteForm_{{ $degree->id }}"
                                            action="{{ route('admin.degrees.destroy', $degree) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.degrees.show', ['degree' => $degree->id]) }}"
                                                class="btn btn-info">
                                                <i class="bi bi-search"></i>
                                            </a>
                                            <a href="{{ route('admin.degrees.edit', ['degree' => $degree]) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-danger " type="button"
                                                onclick="confirmDelete('deleteForm_{{ $degree->id }}')">
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
    <div class="modal" tabindex="-1" role="dialog" style="display:none" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $('#exampleModal .modal-title').text(modalTitle);
            $('#exampleModal .modal-body').html(modalBody);

            // Show the modal
            $('#exampleModal').modal('show');

            // Set up a click event for the "Save changes" button in the modal
            $('#exampleModal .modal-footer .btn-primary').click(function() {
                document.getElementById(formId).submit();
            });
        }

        function showModal(event) {
            console.log("modal opened");
            $('#exampleModal').modal('show');
            event.preventDefault();
        }

        function submitForm() {
            $('#new_group').submit();
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
