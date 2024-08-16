<?php

namespace App\Http\Controllers;

use App\Models\LOGISTIC\MESSAGE\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Contar mensajes no leídos
        $unreadMessages = Message::where('receiver_id', Auth::id())->where('read', false)->count();

        return view('home', compact('unreadMessages'));
    }
}
