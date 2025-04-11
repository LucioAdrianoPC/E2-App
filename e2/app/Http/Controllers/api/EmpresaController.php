<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\empresas;

class EmpresaController extends Controller
{
    public function index()
    {
        return empresas::all();
    }

    public function store(Request $request)
    {
        empresas::create($request->all());
    }


    public function show(string $id)
    {
        return empresas::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $empresas = empresas::findOrFail($id);
        $empresas->update($request->all());
    }


    public function destroy(string $id)
    {
        $empresas = empresas::findOrFail($id);
        $empresas->delete();
    }

    public function popCadastro($id){
        $empresas = DB::table('empresas')
        ->select('empresas.*', 'municipios.idMunicipio', 'municipios.nomeMunicipio', 'municipios.ufMunicipio', 'municipios.cep', 'municipios.pais', 'municipios.id_estado')
        ->where('empresas.idEmpresa', '=', $id)
        ->join('municipios', 'idMunicipio', '=', 'empresas.id_municipio')
        ->get();
        return response()->json($empresas);
    }

    public function popEmpresasA(){
        $empresasA = DB::table('empresas')
        ->select('idEmpresa', 'empresa', 'cnpj', 'flg_status')
        ->where('flg_status', '=', 'A')
        ->orderby('empresa', 'ASC')
        ->paginate(20);
        return response()->json($empresasA);
    }

    public function popEmpresasI(){
        $empresasI = DB::table('empresas')
        ->select('idEmpresa', 'empresa', 'cnpj', 'flg_status')
        ->where('flg_status', '=', 'I')
        ->orderby('empresa', 'ASC')
        ->paginate(20);
        return response()->json($empresasI);
    }

    public function ativaInativa($id, $ai){
        $status = empresas::where('idEmpresa', $id)->update(['flg_status' => $ai]);
        return response()->json($status);
    }

    public function pesquisarNome($nome)
    {
        $pesquisar = DB::table('empresas')
        ->select('idEmpresa', 'empresa', 'cnpj', 'flg_status')
        ->where('empresa','LIKE',"%{$nome}%")
        ->get();
        return response()->json($pesquisar);
    }

    public function pesquisarCNPJ($cnpj)
    {
        $pesquisarcnpj = DB::table('empresas')
        ->select('idEmpresa', 'empresa', 'cnpj', 'flg_status')
        ->where('cnpj','LIKE',"{$cnpj}%")
        ->get();
        return response()->json($pesquisarcnpj);
    }

    public function existeCNPJ($cnpj)
    {
        $cnpj_ = Str::replace('_', '/', $cnpj);

        $existecnpj = DB::table('empresas')
        ->select('*')
        ->where('cnpj','=', $cnpj_)
        ->get();
        return response()->json($existecnpj);
    }

    public function municipioAuto($nome){
        $municipios = DB::table('municipios')
        ->select('idMunicipio', 'nomeMunicipio', 'ufMunicipio', 'id_estado')
        ->where('nomeMunicipio', '=', $nome)
        ->get();
        return response()->json($municipios);
    }
}
