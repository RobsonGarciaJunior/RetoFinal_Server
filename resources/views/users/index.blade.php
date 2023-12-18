@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <h3>Espacio personal de {{ Auth::user()->name }}</h3>
     </div>
    <div class="accordion" id="ciclosFormativosAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse" aria-expanded="true"
                            aria-controls="collapse">Módulo:
                    </button>
                </h2>
                <div id="collapse" class="accordion-collapse collapse show"
                     aria-labelledby="heading">
                     <div class="accordion-body">
                        @foreach ($users as $user)
                        @if($user->roles->contains(2))
                        <div class="user-info">
                            <p><strong>Profesor:</strong> {{ $user->nombre }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>
                        <hr class="user-separator">
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
