@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="mt-2">{{ $user->name }} {{ $user->surname }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="mb-3">
                                <label for="DNI" class="form-label">{{ trans('app.DNI') }}</label>
                                <div class="border rounded p-2">
                                    <span>{{ $user->DNI }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-fill me-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ trans('app.name') }}</label>
                                        <div class="border rounded p-2">
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-fill">
                                    <div class="mb-3">
                                        <label for="surname" class="form-label">{{ trans('app.surname') }}</label>
                                        <div class="border rounded p-2">
                                            <span>{{ $user->surname }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-fill me-3">
                                    <div class="mb-3">
                                        <label for="phoneNumber1" class="form-label">{{ trans('app.phoneNumber1') }}</label>
                                        <div class="border rounded p-2">
                                            <span>{{ $user->phone_number1 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-fill me-3">
                                    <div class="mb-3">
                                        <label for="phoneNumber2" class="form-label">{{ trans('app.phoneNumber2') }}</label>
                                        <div class="border rounded p-2">
                                            <span>{{ $user->phone_number2 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">{{ trans('app.address') }}</label>
                                <div class="border rounded p-2">
                                    <span>{{ $user->address }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ trans('app.email') }}</label>
                                <div class="border rounded p-2">
                                    <span>{{ $user->email }}</span>
                                </div>
                            </div>
                            @if ($user->department)
                                <div class="mb-3">
                                    <label for="department" class="form-label">{{ trans('app.department') }}</label>
                                    <div class="border rounded p-2">
                                        <span>{{ $user->department->name }}</span>
                                    </div>
                            @endif
                            <div class="mb-3">
                                <label for="role" class="form-label">{{ trans('app.roles') }}</label>
                                <div class="border rounded p-2">
                                    @foreach ($user->roles as $role)
                                    <span>{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
