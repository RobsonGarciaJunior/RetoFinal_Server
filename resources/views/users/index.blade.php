@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-center mb-4">{{trans('app.elorrieta_users') }}</h3>
        <br>
    </div>

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
                @forelse($usersPaginated as $user)
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
        {{ $usersPaginated->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
