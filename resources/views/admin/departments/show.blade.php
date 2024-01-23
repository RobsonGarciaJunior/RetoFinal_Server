@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2">{{ $department->name }}</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="mt-2 mb-4">{{trans('app.users_department') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{trans('app.name') }}</th>
                                        <th>{{trans('app.surname') }}</th>
                                        <th>{{trans('app.email') }}</th>
                                        <th>{{trans('app.phone') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($department->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number1 }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">{{trans('app.no_user') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div id='pagination' class="text-right">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
