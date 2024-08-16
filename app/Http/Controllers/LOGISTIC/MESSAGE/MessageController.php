<?php
namespace App\Http\Controllers\LOGISTIC\MESSAGE;

use App\Http\Controllers\Controller;
use App\Models\LOGISTIC\MESSAGE\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{


public function index(Request $request)
{
    $userId = Auth::id(); // Obtener el ID del usuario autenticado

    // Obtener el ID del usuario con el que se está chateando
    $receiverId = $request->query('receiver_id');

    if ($receiverId) {
        // Obtener los mensajes entre el usuario autenticado y el receptor
        $messages = Message::where(function($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc') // Cambiar a 'asc' para mostrar mensajes en orden cronológico
        ->get();

        // Marcar como leídos los mensajes recibidos del receptor actual
        Message::where('sender_id', $receiverId)
            ->where('receiver_id', $userId)
            ->where('read', false)
            ->update(['read' => true]);

        // Obtener el nombre del usuario con el que se está chateando
        $chatUser = User::find($receiverId);
    } else {
        $messages = collect();
        $chatUser = null;
    }

    // Contar los mensajes no leídos para cada usuario y obtener el último mensaje
    $users = User::where('user_id', '!=', $userId)
    ->withCount(['sentMessages as unread_messages_count' => function ($query) use ($userId) {
        $query->where('receiver_id', $userId)
              ->where('read', false);
    }])
    ->with(['latestMessage' => function ($query) use ($userId) {
        $query->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        })
        ->orderBy('created_at', 'desc');
    }])
    ->get();


    return view('LOGISTICA.MESSAGE.Message', compact('messages', 'users', 'chatUser'));
}


    public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,user_id',
        'message' => 'nullable|string|max:1000',
        'file' => 'nullable|file|max:10240', // Limita el tamaño a 10MB
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        // Si se ha subido un archivo, almacenarlo y usar la ruta
        $filePath = $request->file('file')->store('messages', 'public');
    }

    // Crear un nuevo mensaje
    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message, // Puede ser null
        'file_path' => $filePath, // Almacena la ruta del archivo
        'read' => false,
    ]);

    // Limitar a 20 mensajes por chat, eliminando los más antiguos
    $this->limitMessages($request->receiver_id);

    return redirect()->route('messages.index', ['receiver_id' => $request->receiver_id])->with('success', 'Mensaje enviado con éxito.');
}

private function limitMessages($receiverId)
{
    $userId = Auth::id();

    // Contar el número total de mensajes en el chat actual
    $messageCount = Message::where(function($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $userId);
        })
        ->count();

    // Si el número total de mensajes excede 20, eliminar los más antiguos
    if ($messageCount > 20) {
        $messagesToDelete = Message::where(function($query) use ($userId, $receiverId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $receiverId);
            })->orWhere(function($query) use ($userId, $receiverId) {
                $query->where('sender_id', $receiverId)
                      ->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->take($messageCount - 20) // Obtener la cantidad de mensajes que exceden el límite
            ->get();

        foreach ($messagesToDelete as $message) {
            if ($message->file_path) {
                // Eliminar archivo del almacenamiento
                Storage::disk('public')->delete($message->file_path);
            }
            $message->delete(); // Eliminar el mensaje
        }
    }
}



}


