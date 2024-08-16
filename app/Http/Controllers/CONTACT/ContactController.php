<?php

namespace App\Http\Controllers\CONTACT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CONTACT\Contact;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(Request $request)
{
    $query = Contact::query();

    // Filtrar por búsqueda si está presente
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('code', 'like', '%' . $request->search . '%')
              ->orWhere('ruc', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    // Filtrar por tipo si está presente
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $contacts = $query->paginate(10);

    // Asegúrate de que la vista apunte a la ubicación correcta
    return view('CONTAC.Contact', compact('contacts'));
}



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'ruc' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        // Generar el código automáticamente
        $code = $this->generateContactCode($request->name, $request->ruc, $request->phone);

        // Crear el contacto
        Contact::create([
            'code' => $code,
            'name' => $request->name,
            'type' => $request->type,
            'ruc' => $request->ruc,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Contact created successfully');
    }

    private function generateContactCode($name, $ruc, $phone)
    {
        $namePart = strtoupper(Str::substr($name, 0, 3)); // Los primeros 3 caracteres del nombre
        $rucPart = $ruc ? strtoupper(Str::substr($ruc, -2)) : ''; // Los últimos 2 dígitos del RUC
        $phonePart = $phone ? strtoupper(Str::substr($phone, -2)) : ''; // Los últimos 2 dígitos del teléfono

        $code = $namePart;

        if ($rucPart) {
            $code .= $rucPart;
        } else {
            $code .= $phonePart;
        }

        return $code;
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'code' => 'required|unique:contacts,code,' . $contact->id,
            'name' => 'required',
            'ruc' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        // Mantener el tipo de contacto igual al original
        $contact->update($request->except(['type']));
        return redirect()->back()->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
    public function edit(Contact $contact)
    {
        return response()->json($contact);
    }

}
