@extends('layouts.AppNav')

@section('content')
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">

<div class="container">
    <h1>Contacts</h1>
    <button class="btn btn-primary" id="create-contact">
        <i class="ph ph-plus" style="margin-right: 5px;"></i> Create Contact
    </button>
    <form method="GET" action="{{ route('contacts.index') }}" class="mt-4">
        <div class="relative mb-4">
            <input
                placeholder="Search contacts..."
                type="search"
                name="search"
                value="{{ request('search') }}"
            />
        </div>
        <div class="form-group mb-4">
            <select name="type" class="form-control">
                <option value="">All Types</option>
                <option value="employee" {{ request('type') == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="customer" {{ request('type') == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="supplier" {{ request('type') == 'supplier' ? 'selected' : '' }}>Supplier</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Type</th>
                <th>RUC</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->code }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ ucfirst($contact->type) }}</td>
                    <td>{{ $contact->ruc }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <button class="btn btn-warning edit-contact" data-id="{{ $contact->id }}">
                            <i class="ph ph-note-pencil" style="font-size: 24px; color: #070707;" ></i>
                        </button>

                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="ph ph-trash-simple" style="font-size: 24px; color: #ffffff;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal/Sidebar for Create and Edit -->
<div id="contact-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title">Create Contact</h2>
        <form id="contact-form" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <input type="hidden" id="contact-id" name="contact_id">
            <input type="hidden" name="_method" value="POST" id="form-method"> <!-- Agregado para método PUT -->
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" id="code" name="code" class="form-control" readonly style="background-color: rgb(202, 200, 200)">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="employee">Employee</option>
                    <option value="customer">Customer</option>
                    <option value="supplier">Supplier</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ruc">RUC</label>
                <input type="text" id="ruc" name="ruc" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script src="{{ asset('js/contact.js') }}"></script>
@endsection
