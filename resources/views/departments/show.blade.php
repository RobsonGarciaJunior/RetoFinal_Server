@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-center mb-4">Departamento de {{ $department->name }}</h3>
        <br>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @php
                $users = $department->users()
                    ->orderBy('surname')
                    ->orderBy('name')
                    ->orderBy('email')
                    ->orderBy('phoneNumber1')
                    ->paginate(config('app.pagination.default'));
            @endphp
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phoneNumber1 }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No hay usuarios en este departamento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id='pagination' class="text-right">
     {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
