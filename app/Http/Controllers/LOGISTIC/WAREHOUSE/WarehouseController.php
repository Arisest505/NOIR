<?php

namespace App\Http\Controllers\LOGISTIC\WAREHOUSE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LOGISTIC\WAREHOUSE\Warehouse;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $query = Warehouse::query();

        // Filtrar por nombre si está presente
        if ($request->filled('name')) {
            $query->where('name_warehouse', $request->name);
        }

        $warehouses = $query->get();
        $names = Warehouse::select('name_warehouse')->distinct()->get();

        // Asumiendo que solo se muestra el primer almacén (puedes cambiar la lógica según sea necesario)
        $warehouse = $warehouses->first();

        return view('LOGISTICA.WAREHOUSE.Warehouse', compact('warehouses', 'names', 'warehouse'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_warehouse' => 'required|string|max:100',
            'location_warehouse' => 'required|string|max:255',
        ]);

        Warehouse::create($request->only(['name_warehouse', 'location_warehouse']));

        return redirect()->route('Warehouses')->with('success', 'Warehouse added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_warehouse' => 'required|string|max:100',
            'location_warehouse' => 'required|string|max:255',
        ]);

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->only(['name_warehouse', 'location_warehouse']));

        return redirect()->route('Warehouses')->with('success', 'Almacén actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        return redirect()->route('Warehouses')->with('success', 'Almacén eliminado exitosamente.');
    }
}












