<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuarios::all();
    }

    public function store(Request $request)
    {
        Usuarios::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    }


    public function show(string $id)
    {
        return Usuarios::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->update($request->all());
    }


    public function destroy(string $id)
    {
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->delete();
    }
}
