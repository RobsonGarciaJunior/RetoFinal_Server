@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <h3>Espacio personal de {{ Auth::user()->name }}</h3>
    </div>
    <div class="accordion" id="accordionGenerico">
        @if(auth()->user()->roles->contains(3))
            @foreach (auth()->user()->degrees as $degree)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{ $degree->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $degree->id }}" aria-expanded="true"
                                aria-controls="collapse_{{ $degree->id }}">
                            {{ $degree->name }}
                        </button>
                    </h2>
                    <div id="collapse_{{ $degree->id }}" class="accordion-collapse collapse show"
                         aria-labelledby="heading_{{ $degree->id }}">
                         <div class="accordion-body">
                            @foreach ($users->sortByDesc(function ($user) use ($degree) {
                                return $user->roles->contains(3) && $user->degrees->contains($degree) ? $user->degrees->find($degree->id)->pivot->registration_date : null;
                            }) as $user)
                                @if($user->roles->contains(3) && $user->degrees->contains($degree))
                                    <div class="user-info">
                                        <p><strong>Fecha de matriculación:</strong> {{ $user->degrees->find($degree->id)->pivot->registration_date }}</p>
                                        <p><strong>Curso:</strong> {{ $user->degrees->find($degree->id)->pivot->year_of_degree }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_department" aria-expanded="true"
                            aria-controls="collapse_department">
                        <!-- Condicion provisional que se puede eliminar cuando redirija a admin -->
                        @if(auth()->user()->department == null)
                            Administradores
                        @else
                            Departamento de {{ auth()->user()->department->name }}
                        @endif
                    </button>
                </h2>
                <div id="collapse_department" class="accordion-collapse collapse show"
                     aria-labelledby="heading">
                    <div class="accordion-body">
                        @foreach ($users as $user)
                            @if(!$user->roles->contains(3) && $user->department == auth()->user()->department)
                                <div class="user-info">
                                    <p><strong>Nombre: </strong>{{ $user->name }} {{ $user->surname }} </p>
                                    <p><strong>Correo: </strong> {{ $user->email }} </p>
                                </div>
                                <hr class="user-separator">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->roles->contains(2))
            <br>
            <h4>Modulos impartidos</h4>

            @foreach (auth()->user()->modules as $module)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_module_{{ $module->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_module_{{ $module->id }}" aria-expanded="true"
                                aria-controls="collapse_module_{{ $module->id }}">
                            {{ $module->name }}
                        </button>
                    </h2>
                    <div id="collapse_module_{{ $module->id }}" class="accordion-collapse collapse show"
                        aria-labelledby="heading_module_{{ $module->id }}">
                        <div class="accordion-body">
                            <div class="students">
                                @foreach ($users as $user)
                                    @if($user->roles->contains(3))
                                        @foreach ($user->modules as $userModule)
                                            @if ($userModule->id === $module->id && $userModule->pivot->year_of_impartion === $module->year_of_impartion)
                                                <div class="user-info">
                                                    <p><strong>Nombre:</strong> {{ $user->name }} {{ $user->surname }}</p>
                                                    <p><strong>Correo:</strong> {{ $user->email }}</p>
                                                </div>
                                                <hr class="user-separator">
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
