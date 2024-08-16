<?php
namespace App\Http\Controllers\LOGISTIC\WAREHOUSE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LOGISTIC\WAREHOUSE\Warehouse;

class InformationWarehouseController extends Controller
{
    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('LOGISTICA.WAREHOUSE.InformationWarehouse', compact('warehouse'));
    }
}
