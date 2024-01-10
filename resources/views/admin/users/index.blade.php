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
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
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
                            <td>{{ $user->phoneNumber1 }}</td>
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
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                        class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
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
    <script>
        function confirmDelete(formId) {
            var deleteConfirmation = "{{ trans('app.delete_user') }}";
            if (confirm(deleteConfirmation)) {
                document.getElementById(formId).submit();
            }
        }

        function confirmSendingToTrash(formId) {
            var sendToTrashConfirmation = "{{ trans('app.sendToTrash_user') }}";
            if (confirm(sendToTrashConfirmation)) {
                document.getElementById(formId).submit();
            }
        }

        function confirmRestore(formId) {
            var restoreConfirmation = "{{ trans('app.restore_user') }}";
            if (confirm(restoreConfirmation)) {
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
