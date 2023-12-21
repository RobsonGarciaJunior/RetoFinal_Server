@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-center mb-4">{{trans('app.elorrieta_departments') }}</h3>
        <br>
    </div>
    <div class="row">
        @foreach ($departments as $department)
            <div class="col-md-4 mb-4">
                <div class="card text-center" id="card-departamento">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a id="link" href="{{ route('departments.show', ['department' => $department->id]) }}">
                                {{ $department->name }}
                            </a></h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
