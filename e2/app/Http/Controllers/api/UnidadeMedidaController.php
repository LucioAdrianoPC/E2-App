<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\unidadeMedida;

class UnidadeMedidaController extends Controller
{
    public function index()
    {
        return unidadeMedida::all();
    }

    public function store(Request $request)
    {
        unidadeMedida::create($request->all());
    }


    public function show(string $id)
    {
        return unidadeMedida::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $unidadeMedida = unidadeMedida::findOrFail($id);
        $unidadeMedida->update($request->all());
    }


    public function destroy(string $id)
    {
        $unidadeMedida = unidadeMedida::findOrFail($id);
        $unidadeMedida->delete();
    }
}
