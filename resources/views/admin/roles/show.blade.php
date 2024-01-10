@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="mt-2">{{ $role->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mt-2 mb-4">{{trans('app.users_role') }}</h5>
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
                                   @forelse($role->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phoneNumber1 }}</td>
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
