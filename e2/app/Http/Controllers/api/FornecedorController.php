<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        return fornecedor::all();
    }

    public function store(Request $request)
    { 
        fornecedor::create($request->all());
    }


    public function show(string $id)
    {
        return fornecedor::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $fornecedores = fornecedor::findOrFail($id);
        $fornecedores->update($request->all());
    }


    public function destroy(string $id)
    {
        $fornecedores = fornecedor::findOrFail($id);
        $fornecedores->delete();
    }

    public function popCadastro($id){
        $fornecedores = DB::table('fornecedores')
        ->select('fornecedores.*', 'municipios.idMunicipio', 'municipios.nomeMunicipio', 'municipios.ufMunicipio', 'municipios.cep', 'municipios.pais', 'municipios.id_estado')
        ->where('fornecedores.idFornecedor', '=', $id)
        ->join('municipios', 'idMunicipio', '=', 'fornecedores.municipio')
        ->get();
        return response()->json($fornecedores);
    }

    public function popfornecedoresA(){
        $fornecedoresA = DB::table('fornecedores')
        ->select('idfornecedor', 'fornecedor', 'cnpj', 'flg_status')
        ->where('flg_status', '=', 'A')
        ->orderby('fornecedor', 'ASC')
        ->paginate(20);
        return response()->json($fornecedoresA);
    }

    public function popfornecedoresI(){
        $fornecedoresI = DB::table('fornecedores')
        ->select('idfornecedor', 'fornecedor', 'cnpj', 'flg_status')
        ->where('flg_status', '=', 'I')
        ->orderby('fornecedor', 'ASC')
        ->paginate(20);
        return response()->json($fornecedoresI);
    }

    public function ativaInativa($id, $ai){
        $status = fornecedor::where('idFornecedor', $id)->update(['flg_status' => $ai]);
        return response()->json($status);
    }

    public function pesquisarNome($nome)
    {
        $pesquisar = DB::table('fornecedores')
        ->select('idfornecedor', 'fornecedor', 'cnpj', 'flg_status')
        ->where('fornecedor','LIKE',"%{$nome}%")
        ->get();
        return response()->json($pesquisar);
    }

    public function pesquisarCNPJ($cnpj)
    {
        $pesquisarcnpj = DB::table('fornecedores')
        ->select('idfornecedor', 'fornecedor', 'cnpj', 'flg_status')
        ->where('cnpj','LIKE',"{$cnpj}%")
        ->get();
        return response()->json($pesquisarcnpj);
    }

    public function existeCNPJ($cnpj)
    {
        $cnpj_ = Str::replace('_', '/', $cnpj);

        $existecnpj = DB::table('fornecedores')
        ->select('*')
        ->where('cnpj','=', $cnpj_)
        ->get();
        return response()->json($existecnpj);
    }
    public function estufaE2(){
        $fornecedores = DB::table('fornecedores')
        ->select('idFornecedor')
        ->where('fornecedor', '=', 'ESTUFA E2 SERVIÇOS LTDA')
        ->get();
        return response()->json($fornecedores);
    }
}


