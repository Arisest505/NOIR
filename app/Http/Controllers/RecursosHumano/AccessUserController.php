<?php


namespace App\Http\Controllers\RecursosHumano;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;

class AccessUserController extends Controller
{
    public function show($id)
    {
        // Obtener el usuario por su ID
        $user = User::with(['staff'])->findOrFail($id);
        $permissions = Permission::all();

        // Pasar los datos del usuario a la vista
        return view('rh.accesouser', compact('user', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Obtener los permisos seleccionados desde la solicitud
        $permissionIds = $request->input('permissions', []);

        // Sincronizar permisos del usuario (elimina los permisos actuales y asigna los seleccionados)
        $user->permissions()->sync($permissionIds);

        return redirect()->route('recursoshumanos.users.access', $id)->with('success', 'Permisos actualizados correctamente.');
    }
    
}
