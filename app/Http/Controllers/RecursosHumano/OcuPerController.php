<?php


namespace App\Http\Controllers\RecursosHumano;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Occupation;
use App\Models\Permission;
class OcuPerController extends Controller
{
    public function index(){

        $occupations = Occupation::all();
        $permissions = Permission::orderBy('permission_id', 'asc')->get();
        return view('rh.Ocuper', compact('occupations', 'permissions'));
    }
    public function store(Request $request) {
        // Validar los datos
        $request->validate([
            'name_occupation' => 'required|string|max:50',
        ]);

        // Crear una nueva ocupación
        $occupation = Occupation::create([
            'name_occupation' => $request->input('name_occupation'),
        ]);

        // Devolver una respuesta JSON
        return response()->json([
            'success' => true,
            'occupation' => $occupation
        ]);
    }

    public function storePermission(Request $request) {
        // Validar los datos
        $request->validate([
            'name_permission' => 'required|string|max:255|unique:permissions,name',
        ]);
        // Agregar el prefijo "manage_" al nombre del permiso
        $permissionName = 'manage_' . $request->input('name_permission');

        // Crear un nuevo permiso
        $permission = Permission::create([
            'name' => $permissionName,
        ]);


        // Devolver una respuesta JSON
        return response()->json([
            'success' => true,
            'permission' => $permission
        ]);
    }




    public function destroy($id) {
        // Buscar la ocupación por ID y eliminarla
        $occupation = Occupation::findOrFail($id);
        $occupation->delete();

        // Devolver una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Ocupación eliminada exitosamente'
        ]);
    }

    public function destroyPermission($id) {
        // Buscar el permiso por ID y eliminarlo
        $permission = Permission::findOrFail($id);
        $permission->delete();

        // Devolver una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Permiso eliminado exitosamente'
        ]);
    }

}
