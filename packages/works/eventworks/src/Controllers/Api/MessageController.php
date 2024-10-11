<?php

namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Obtener todos los mensajes de un thread (hilo) específico
    public function getMessagesByThread($thread)
    {
        // Obtener todos los mensajes del hilo
        $messages = Message::where('thread', $thread)->get();

        return response()->json($messages);
    }
}
