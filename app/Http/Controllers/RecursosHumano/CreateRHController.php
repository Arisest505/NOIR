<?php

namespace App\Http\Controllers\RecursosHumano;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Occupation;

class CreateRHController extends Controller
{
    public function index()
    {
        $users = User::with('staff')->get();
        $staff = Staff::all();
        $occupations = Occupation::all();
        return view('rh.createuser', compact('staff', 'users', 'occupations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_staff_user' => 'required|exists:staff,staff_id',
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'id_staff_user' => $validated['id_staff_user'],
        ]);
    
        return response()->json([
            'success' => 'Usuario creado exitosamente.',
            'user' => $user->load('staff') // Cargar la relación con el modelo Staff
        ]);
    }
    public function storeStaff(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_staff' => 'required|string|max:40',
                'apat_staff' => 'required|string|max:30',
                'apmat_staff' => 'required|string|max:30',
                'dni_staff' => 'required|string|size:8|unique:staff,dni_staff',
                'birthdate_staff' => 'required|date',
                'phone_staff' => 'required|string|size:9',
                'email_staff' => 'required|string|email|max:150|unique:staff,email_staff',
                'bank_account_staff' => 'required|string|max:40|unique:staff,bank_account_staff',
                'id_occupation_staff' => 'required|exists:occupation,occupation_id',
            ]);
    
            $staff = Staff::create($validated);
    
            // Obtener la lista actualizada de todos los Staff
            $staffList = Staff::all();
    
            return response()->json([
                'success' => 'Personal creado exitosamente.',
                'staff' => $staff,
                'staffList' => $staffList, // Incluir la lista actualizada
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error al crear el personal: " . $e->getMessage());
    
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.'
            ], 500);
        }
    }
}    
