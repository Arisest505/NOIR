@extends('layouts.appnav')

@section('title', 'Creación de Ocupacion')

@section('styles')
    <link href="{{ asset('css/OcuPer.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 id="pageTitle">Ocupacion</h1>
    <button id="openModalButton" class="btn btn-primary">Crear Nuevo Ocupacion</button>

    <label class="switch">
        <input type="checkbox" id="toggleSwitch" checked>
        <span class="slider"></span>
    </label>

    <!-- Tabla para mostrar ocupaciones y permisos según el estado del interruptor -->
    <div id="occupationTable" class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Ocupación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="occupationTableBody">
                @foreach($occupations as $occupation)
                <tr>
                    <td>{{ $occupation->occupation_id }}</td>
                    <td>{{ $occupation->name_occupation }}</td>
                    <td><button class="btn-delete" data-id="{{ $occupation->occupation_id }}">Eliminar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="permissionTable" class="table-container" style="display: none;">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Permiso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="permissionTableBody">
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->permission_id }}</td>
                    <td>{{ $permission->name}}</td>
                    <td><button class="btn-delete-permission" data-id="{{ $permission->permission_id }}">Eliminar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para crear nueva ocupación -->
<div id="createOccupationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Crear Nueva Ocupación</h2>
        <form id="createOccupationForm">
            <div class="form-group">
                <label for="name_occupation">Nombre de la Ocupación</label>
                <input type="text" id="name_occupation" name="name_occupation" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal para crear nuevo permiso -->
<div id="createPermissionModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Crear Nuevo Permiso</h2>
        <form id="createPermissionForm">
            <div class="form-group">
                <label for="name_permission">Nombre del Permiso</label>
                <input type="text" id="name_permission" name="name_permission" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/OcuPer.js') }}"></script>
@endsection
