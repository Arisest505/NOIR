@extends('layouts.appnav')

@section('title', 'Detalles del Usuario')

@section('styles')
    <link href="{{ asset('css/accesouser.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h1>Detalles del Usuario</h1>
        <button id="backButton" class="btn btn-primary" data-back-url="{{ route('recursoshumanos.createuser') }}">Volver a la Lista de Usuarios</button>
    </div>
    
    <div class="user-details">
        <p><strong>ID:</strong> {{ $user->user_id }}</p>
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
        <p><strong>Personal:</strong> {{ $user->staff->name_staff }} {{ $user->staff->apat_staff }}</p>
    </div>

    <div class="access-container">
        <button id="grantAccessButton" class="btn btn-secondary" data-user-id="{{ $user->user_id }}">Brindar Accesos</button>
    </div>

    <!-- Modal para selección de permisos -->
    <div id="permissionsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Seleccionar Permisos</h2>
            <form id="permissionsForm" method="POST" action="{{ route('recursoshumanos.users.update', $user->user_id) }}">
                @csrf
                @method('PUT')
            
                <div id="permissionsList">
                    @foreach($permissions as $permission)
                        <div>
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->permission_id }}"
                                    {{ $user->permissions->contains($permission->permission_id) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar Permisos</button>
            </form>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/accesouser.js') }}"></script>
@endsection
