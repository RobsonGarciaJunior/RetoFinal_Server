@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mb-4">
            <h3 class="text-center mb-4">{{ trans('app.elorrieta_users') }}</h3>
            <br>
        </div>
        <div>
            <a href="{{ route('admin.users.index', ['archive' => 1]) }}">Archivados</a>
            <a>({{ $trashedCount }})</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('app.name') }}</th>
                        <th>{{ trans('app.surname') }}</th>
                        <th>{{ trans('app.email') }}</th>
                        <th>{{ trans('app.phone') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usersPaginated as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                    @if (!$loop->last)
                                        {{-- Agrega una coma si no es el último rol --}}
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phoneNumber1 }}</td>
                            <td>
                                @if ($user->trashed())
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-primary" type="submit"
                                            onclick="return confirm('Are u sure bro?')">
                                            Restaurar
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.force_delete', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Are u sure bro?')">
                                            Borrar Definitivamente
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                        class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                    <form id="deleteForm_{{ $user->id }}"
                                        action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        @can('user_deletable')
                                        <button class="btn btn-danger" type="button"
                                            onclick="confirmDelete('deleteForm_{{ $user->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg>
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
    </script>
@endsection
