@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edición de contraseña</div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ "La contraseña debe tener al menos 8 carácteres" }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-2" name="change_password_form" action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for "password2" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="password3" class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="password3" name="password3" required />
                    </div>

                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
@endsection
