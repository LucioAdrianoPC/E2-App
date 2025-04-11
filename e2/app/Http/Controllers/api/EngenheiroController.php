<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\engenheiro;

class EngenheiroController extends Controller
{
    public function index()
    {
        return engenheiro::all();
    }

    public function store(Request $request)
    {
        engenheiro::create($request->all());
    }


    public function show(string $id)
    {
        return engenheiro::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $engenheiros = engenheiro::findOrFail($id);
        $engenheiros->update($request->all());
    }


    public function destroy(string $id)
    {
        $engenheiros = engenheiro::findOrFail($id);
        $engenheiros->delete();
    }

    public function popCadastro($id){
        $engenheiros = DB::table('engenheiros')
        ->select('*')
        ->where('idEngenheiro', '=', $id)
        ->get();
        return response()->json($engenheiros);
    }

    public function popEngenheirosA(){
        $engenheirosA = DB::table('engenheiros')
        ->select('idEngenheiro', 'nome', 'crea', 'flg_status')
        ->where('flg_status', '=', 'A')
        ->orderby('nome', 'ASC')
        ->paginate(10);
        return response()->json($engenheirosA);
    }

    public function popEngenheirosI(){
        $engenheirosI = DB::table('engenheiros')
        ->select('idEngenheiro', 'nome', 'crea', 'flg_status')
        ->where('flg_status', '=', 'I')
        ->orderby('nome', 'ASC')
        ->paginate(10);
        return response()->json($engenheirosI);
    }

    public function ativaInativa($id, $ai){
        $status = engenheiro::where('idEngenheiro', $id)->update(['flg_status' => $ai]);
        return response()->json($status);
    }

    public function pesquisarNome($nome)
    {
        $pesquisar = DB::table('engenheiros')
        ->select('idEngenheiro', 'nome', 'crea', 'flg_status')
        ->where('nome','LIKE',"%{$nome}%")
        ->get();
        return response()->json($pesquisar);
    }
}
