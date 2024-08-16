@extends('layouts.appnav')

@section('content')
<link rel="stylesheet" href="{{ asset('css/infowarehouse.css') }}">

<div class="warehouse-container">
    <div class="header-flex">
        <h1>Almacén Central</h1>
        <a href="{{ route('Warehouses') }}" class="btn-back">
            <i class="fa fa-arrow-left"></i> Atrás
        </a>
    </div>
    <div class="warehouse-header">
        <div class="warehouse-info">
            <div class="warehouse-location">
                <h3>Ubicación</h3>
                <p><i class="fa fa-map-marker"></i> Calle Principal 123, Ciudad</p>
            </div>
            <div class="warehouse-details">
                <h3>Detalles</h3>
                <p><i class="fa fa-cubes"></i> 1200 productos en stock</p>
                <p><i class="fa fa-calendar"></i> Última actualización: 15/06/2023</p>
            </div>
        </div>
        <a href="#" class="btn-view-products">
            <i class="fa fa-box"></i> Ver Productos
        </a>
    </div>

    <!-- Nueva sección añadida -->
    <div class="grid-container">
        <div class="card">
            <h3>Resumen de Inventario</h3>
            <p>Productos en stock: <strong>1,234</strong></p>
            <p>Productos agotados: <strong>56</strong></p>
            <p>Valor total del inventario: <strong>$125,678.00</strong></p>
        </div>
        <div class="card">
            <h3>Próximos Pedidos</h3>
            <p>Pedidos pendientes: <strong>12</strong></p>
            <p>Valor total de pedidos: <strong>$32,456.00</strong></p>
            <p>Fecha de entrega más cercana: <strong>2023-06-15</strong></p>
        </div>
        <div class="card">
            <h3>Espacio Disponible</h3>
            <p>Capacidad total: <strong>5,000 m²</strong></p>
            <p>Espacio ocupado: <strong>3,786 m²</strong></p>
            <p>Espacio disponible: <strong>1,214 m²</strong></p>
        </div>
        <div class="card">
            <h3>Alertas</h3>
            <p>Productos por debajo del mínimo: <strong class="text-red-500">8</strong></p>
            <p>Pedidos atrasados: <strong class="text-red-500">3</strong></p>
            <p>Productos próximos a caducar: <strong class="text-yellow-500">14</strong></p>
        </div>
    </div>
</div>
@endsection
