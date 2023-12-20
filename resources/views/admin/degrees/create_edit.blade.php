@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if (isset($degree))
                    Edición de Ciclo
                @else
                    Creación de Ciclo
                @endif
            </div>
        </div>
    </div>
@endsection
