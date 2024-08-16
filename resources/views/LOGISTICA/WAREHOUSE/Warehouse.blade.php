@extends('layouts.appnav')

@section('content')
<link rel="stylesheet" href="{{ asset('css/warehouse.css') }}">

<div class="warehouse-container">
    <h1>Almacenes</h1>
    <p>Gestiona y supervisa tus almacenes.</p>
    <div class="warehouse-grid">
        @foreach($warehouses as $warehouse)
            <div class="warehouse-card">
                <h3>{{ $warehouse->name_warehouse }}</h3>
                <p><strong>Ubicación:</strong> {{ $warehouse->location_warehouse }}</p>
                <p>Productos en stock: <strong>{{ number_format($warehouse->products_in_stock) }}</strong></p>
                <p>Productos agotados: <strong>{{ $warehouse->products_out_of_stock }}</strong></p>
                <p>Valor total del inventario: <strong>${{ number_format($warehouse->total_inventory_value, 2) }}</strong></p>
                <a href="{{ route('warehouses.show', $warehouse->warehouse_id) }}" class="btn-info">Más información</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
