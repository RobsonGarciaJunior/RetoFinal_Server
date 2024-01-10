@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="align-items-center">
                            <h5 class="mt-2 text-center">{{ trans('app.welcome') }}</h5>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('img/centro.jpg') }}" class="mx-auto img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
