<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
        return view('user.contacto');
    }

    public function enviar(Request $request)
    {

        if ($request->middlename !== null) {
            return;
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ], [
            'email' => 'El email indicado no es válido',
        ]);

        $url = 'mailto:' . $request->email;
        $correo = [
            'nombre' => $request->name,
            'email' => $request->email,
            'mensaje' => $request->message,
            'url' => $url,
        ];

        Mail::to(env('USER_EMAIL'))->send(new Contacto($correo));
        return redirect()->back()->with('info', 'El mensaje se ha enviado correctamente');
    }
}
