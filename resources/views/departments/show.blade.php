@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-center mb-4">{{trans('app.department_of') }} {{ $department->name }}</h3>
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
                @php
                $users = $department->users()
                    ->orderBy('surname')
                    ->orderBy('name')
                    ->orderBy('email')
                    ->orderBy('phoneNumber1')
                    ->paginate(config('app.pagination.default'));
            @endphp
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phoneNumber1 }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">{{trans('app.no_user_department') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id='pagination' class="text-right">
     {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
