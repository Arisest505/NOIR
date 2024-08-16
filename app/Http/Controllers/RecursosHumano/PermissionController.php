<?php

namespace App\Http\Controllers\RecursosHumano;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => $permissions]);
    }
}
