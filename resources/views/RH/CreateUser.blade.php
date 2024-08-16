@extends('layouts.appnav')

@section('title', 'Creación de Usuario')

@section('styles')
    <link href="{{ asset('css/createuser.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1>Usuarios</h1>
    <button id="openModalButton" class="btn btn-primary">Crear Nuevo Usuario</button>
    
    <!-- Contenedor para la tabla -->
    <div class="table-wrapper">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Personal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->staff->name_staff }} {{ $user->staff->apat_staff }}</td>
                  <td>
                    <button class="btn btn-info access-button" data-id="{{ $user->user_id }}">Brindar Accesos</button>
                </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Structure -->
<div id="userModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestión de Usuarios</h5>
                <button type="button" class="close" id="closeModalButton" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="userModalTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="createUserTab" href="#createUserContent">Crear Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="staffDetailsTab" href="#staffDetailsContent">Datos del Personal</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="createUserContent">
                        <form id="createUserForm" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_staff_user" class="form-label">ID del Personal</label>
                                <select class="form-select" id="id_staff_user" name="id_staff_user" required>
                                    <option value="" disabled selected>Seleccionar Personal</option>
                                    @foreach($staff as $staffMember)
                                    <option value="{{ $staffMember->staff_id }}">{{ $staffMember->name_staff }} {{
                                        $staffMember->apat_staff }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                            <div id="formError" class="text-danger mt-3"></div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="staffDetailsContent">
                        <form id="staffDetailsForm" method="POST" action="{{ route('recursoshumanos.staff.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name_staff" class="form-label">Nombre del Personal</label>
                                <input type="text" class="form-control" id="name_staff" name="name_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="apat_staff" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apat_staff" name="apat_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="apmat_staff" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apmat_staff" name="apmat_staff" required>
                            </div>                                                        
                            <div class="mb-3">
                                <label for="dni_staff" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni_staff" name="dni_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate_staff" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="birthdate_staff" name="birthdate_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_staff" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="phone_staff" name="phone_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="email_staff" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email_staff" name="email_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="bank_account_staff" class="form-label">Cuenta Bancaria</label>
                                <input type="text" class="form-control" id="bank_account_staff" name="bank_account_staff" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_occupation_staff" class="form-label">ID de Ocupación</label>
                                <select class="form-select" id="id_occupation_staff" name="id_occupation_staff" required>
                                    <option value="" disabled selected>Seleccionar Ocupación</option>
                                    <!-- Aquí deberías cargar las opciones de la base de datos -->
                                    @foreach($occupations as $occupation)
                                        <option value="{{ $occupation->occupation_id }}">{{ $occupation->name_occupation }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Detalles</button>
                            <div id="formError" class="text-danger mt-3"></div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        const storeUrl = "{{ route('recursoshumanos.users.store') }}";
        const storeStaffUrl = "{{ route('recursoshumanos.staff.store') }}";
    </script>
    <script src="{{ asset('js/createuser.js') }}"></script>
@endsection
