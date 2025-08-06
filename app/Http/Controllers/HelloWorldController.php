<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    public function hello(string $name, Request $request)
    {
        //return "HELLO ".$name." from Controller!";
        //return response()->json(data:'HELLO '.$name.' from Controlle by JSON.');
        return response()->json([
            'saldacao' => 'Hello',
            'nome' => $name,
            'finalizacao' => 'from Controller by JSON',
            'extras' => $request->all()
        ]);
    }
}
