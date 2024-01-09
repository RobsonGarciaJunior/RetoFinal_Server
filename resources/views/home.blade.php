@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 text-center">
        <h3>{{trans('app.home') }} {{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
    </div>

    <div class="accordion" id="accordionGenerico">
        @if(auth()->user()->roles->contains(3))
            @foreach (auth()->user()->degrees as $degree)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading_{{ $degree->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $degree->id }}" aria-expanded="true"
                                aria-controls="collapse_{{ $degree->id }}">
                            {{ $degree->name }}
                        </button>
                    </h2>
                    <div id="collapse_{{ $degree->id }}" class="accordion-collapse collapse show"
                         aria-labelledby="heading_{{ $degree->id }}">
                         <div class="accordion-body rounded">
                            @foreach ($users->sortByDesc(function ($user) use ($degree) {
                                return $user->roles->contains(3) && $user->degrees->contains($degree) ? $user->degrees->find($degree->id)->pivot->registration_date : null;
                            }) as $user)
                                @if($user->roles->contains(3) && $user->degrees->contains($degree))
                                    <div class="user-info">
                                        <p><strong>{{trans('app.registration_date') }}</strong> {{ $user->degrees->find($degree->id)->pivot->registration_date }}</p>
                                        <p><strong>{{trans('app.course_of') }}</strong> {{ $user->degrees->find($degree->id)->pivot->year_of_degree }}</p>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_department" aria-expanded="true"
                            aria-controls="collapse_department">
                        @if(auth()->user()->department == null)
                        @else
                        {{trans('app.department_of') }} {{ auth()->user()->department->name }}
                        @endif
                    </button>
                </h2>
                <div id="collapse_department" class="accordion-collapse collapse show"
                     aria-labelledby="heading">
                    <div class="accordion-body rounded">
                        @foreach ($users as $user)
                            @if(!$user->roles->contains(3) && $user->department == auth()->user()->department)
                                <div class="user-info">
                                    <p><strong>{{trans('app.name_of') }} </strong>{{ $user->name }} {{ $user->surname }} </p>
                                    <p><strong>{{trans('app.email_of') }} </strong> {{ $user->email }} </p>
                                </div>
                                <hr class="user-separator">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="accordion" id="accordionGenerico">
            @if(auth()->user()->roles->contains(2))
            <h4 class="mb-3 text-center">{{trans('app.modules_teacher') }}</h4>

            @foreach (auth()->user()->modules as $module)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading_module_{{ $module->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_module_{{ $module->id }}" aria-expanded="true"
                                aria-controls="collapse_module_{{ $module->id }}">
                            {{ $module->name }} {{ $module->code }}
                        </button>
                    </h2>
                    <div id="collapse_module_{{ $module->id }}" class="accordion-collapse collapse show"
                        aria-labelledby="heading_module_{{ $module->id }}">
                        <div class="accordion-body rounded">
                            <div class="students">
                                @php
                                    $studentsFound = false;
                                @endphp

                                @foreach ($users as $user)
                                    @if($user->roles->contains(3))
                                        @foreach ($user->modules as $userModule)
                                            @if ($userModule->id === $module->id && $userModule->pivot->year_of_impartion === $module->year_of_impartion)
                                                <div class="user-info">
                                                    <p><strong>{{trans('app.name_of') }}</strong> {{ $user->name }} {{ $user->surname }}</p>
                                                    <p><strong>{{trans('app.email_of') }}</strong> {{ $user->email }}</p>
                                                </div>
                                                <hr class="user-separator">
                                                @php
                                                    $studentsFound = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if (!$studentsFound)
                                    <p>{{trans('app.no_students_module') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>
</div>
@endsection
