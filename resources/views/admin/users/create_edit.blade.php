<div class="container">
    <div class="row">
        <div class="card-body">
            <form class="mt-2" name="create_platform"
                @if (isset($user)) action="{{ route('admin.users.update', $user) }}"
                            @else
                            action="{{ route('admin.users.store') }}" @endif
                method="POST" enctype="multipart/form-data">

                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="form-group mb-3">
                    <label for="DNI" class="form-label">{{ trans('app.DNI') }}</label>
                    <input type="text" class="form-control" id="DNI" name="DNI" required
                        value="{{ isset($user) ? $user->DNI : '' }}" />
                </div>
                <div class="d-flex">
                    <div class="flex-fill me-3">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ trans('app.name') }}</label>
                            <input type="text" oninput="updateEmail()" class="form-control" id="name"
                                name="name" required value="{{ isset($user) ? $user->name : '' }}" />
                        </div>
                    </div>
                    <div class="flex-fill me-3">
                        <div class="form-group mb-3">
                            <label for="surname" class="form-label">{{ trans('app.surname') }}</label>
                            <input type="text" oninput="updateEmail()" class="form-control" id="surname"
                                name="surname" required value="{{ isset($user) ? $user->surname : '' }}" />
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-fill me-3">
                        <div class="form-group mb-3">
                            <label for="phoneNumber1" class="form-label">{{ trans('app.phoneNumber1') }}</label>
                            <input type="number" class="form-control" id="phoneNumber1" name="phoneNumber1" required
                                value="{{ isset($user) ? $user->phone_number1 : '' }}" min="111111111" />
                        </div>
                    </div>
                    <div class="flex-fill me-3">
                        <div class="form-group mb-3">
                            <label for="phoneNumber2" class="form-label">{{ trans('app.phoneNumber2') }}</label>
                            <input type="number" class="form-control" id="phoneNumber2" name="phoneNumber2" required
                                value="{{ isset($user) ? $user->phone_number2 : '' }}" min="111111111" />
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">{{ trans('app.address') }}</label>
                    <input type="text" class="form-control" id="address" name="address" required
                        value="{{ isset($user) ? $user->address : '' }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{ trans('app.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" readonly required
                        value="{{ isset($user) ? $user->email : '' }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.department') }}</label>
                    <select class="form-select" name="department_id" id="department_id"
                        @if (!isset($user->department)) disabled="disabled" @endif required>
                        @if (isset($user->department))
                            <option value="" disabled selected></option>
                            @foreach ($departments as $department)
                                <!-- Comprobamos que el usuario no sea nulo para saber si estamos en editar o crear -->
                                <!-- Luego si no es nulo, significa que estamos en editar y hay que hacer otra comprobacion para saber que departamento hemos pasado a la vista -->
                                <option value="{{ $department->id }}"
                                    @if (isset($user)) @if ($user->department->name == $department->name)
                                                selected @endif
                                    @endif>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled selected></option>
                            @foreach ($departments as $department)
                                <!-- Comprobamos que el usuario no sea nulo para saber si estamos en editar o crear -->
                                <!-- Luego en este caso, aunque ya sabemos que el usuario no tiene departamentos, aun asi necesitamos cargarlos para que los pueda seleccionar -->
                                <option value="{{ $department->id }}" @if (isset($user))  @endif>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ trans('app.roles') }}</label>
                    <div class="card p-3">
                        <div class="row">
                            @foreach ($roles as $role)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="checkbox-inline">
                                                <input onchange="updateDepartmentSelection(this)" type="checkbox"
                                                    name="roles[]" id="roles[]" value="{{ $role->id }}"
                                                    @if (isset($user)) @if ($user->roles->contains('name', $role->name))
                                                                checked @endif
                                                    @endif>
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group  mt-2 text-center">
                        @if (isset($user))
                            <button type="submit" class="btn btn-warning">
                                {{ trans('app.update') }}
                            </button>
                        @else
                            <button type="submit" class="btn btn-success">
                                {{ trans('app.create') }}
                            </button>
                        @endif
                    </div>
            </form>
        </div>
    </div>
</div>
<script>
    function updateDepartmentSelection(checkbox) {
        var selectDepartment = document.getElementById('department_id');
        var checkboxes = document.getElementsByName('roles[]');
        var anyCheckboxSelected = false;

        checkboxes.forEach(function(cb) {
            if (cb.checked) {
                anyCheckboxSelected = true;
                return; // Exit the loop early if any checkbox is selected
            }
        });

        if (!anyCheckboxSelected) {
            // If no checkbox is selected, disable and deselect the department select
            selectDepartment.disabled = true;
            selectDepartment.selectedIndex = 0;
        } else if (checkbox.value === '3' && checkbox.checked) {
            // If checkbox with value 3 is selected, deselect other checkboxes and disable the select
            checkboxes.forEach(function(cb) {
                if (cb.value !== '3') {
                    cb.checked = false;
                }
            });
            selectDepartment.disabled = true;
            selectDepartment.selectedIndex = 0;
        } else {
            // If any other checkbox is selected, enable the select and deselect checkbox with value 3
            selectDepartment.disabled = false;
            checkboxes.forEach(function(cb) {
                if (cb.value === '3' && cb !== checkbox) {
                    cb.checked = false;
                }
            });
        }
    }
    function updateEmail() {
        var name = capitalizeFirstLetter(document.getElementById('name').value);
        var surname = capitalizeFirstLetter(document.getElementById('surname').value);
        var email = document.getElementById('email');

        var generatedEmail = name + surname + '@elorrieta.com';
        // Asignar el email generado al campo de email
        email.value = generatedEmail;

    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
</script>
