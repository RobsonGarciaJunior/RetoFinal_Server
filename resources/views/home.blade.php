@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <h1>Nombre del Departamento</h1>
     </div>
    <div class="accordion" id="ciclosFormativosAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse" aria-expanded="true"
                            aria-controls="collapse">Modulo
                    </button>
                </h2>
                <div id="collapse" class="accordion-collapse collapse show"
                     aria-labelledby="heading">
                    <div class="accordion-body">
                            <p><strong>Alumno:</strong> </p>
                            <p><strong>Email:</strong></p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
