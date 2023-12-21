@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-center mb-4">{{trans('app.elorrieta_degrees') }}</h3>
        <br>
    </div>
    <div class="accordion" id="accordionCiclos">
        @foreach ($degrees as $degree)
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
                        @foreach ($degree->modules as $module)
                        <p><strong>{{ $module->name }}</strong></p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
