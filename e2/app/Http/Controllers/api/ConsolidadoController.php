<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\consolidado;

class ConsolidadoController extends Controller
{
    public function index()
    {
        return consolidado::all();
    }

    public function store(Request $request)
    {
        consolidado::create($request->all());
    }


    public function show(string $id)
    {
        return consolidado::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $consolidado = consolidado::findOrFail($id);
        $consolidado->update($request->all());
    }


    public function destroy(string $id)
    {
        $consolidado = consolidado::findOrFail($id);
        $consolidado->delete();
    }
    
    public function enderecoEmpresa($id){
        $endereco = DB::table('empresas')
        ->select('empresas.*', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('idEmpresa', '=', $id)
        ->join('municipios', 'municipios.idMunicipio', '=', 'empresas.id_municipio')
        ->get();
        return response()->json($endereco);
    }

    public function popRemetente(){
        $empresa = DB::table('empresas')
        ->select('idEmpresa', 'empresa')
        ->orderby('empresa', 'ASC')
        ->get();
        return response()->json($empresa);
    }

    public function popConsolidadoA(){
        $cerA = DB::table('consolidados')
        ->select('consolidados.idConsolidado', 'consolidados.numeroConsolidado', 'consolidados.ciclo', 'consolidados.flg_status', 'consolidados.marca', 'consolidados.sequencia')
        ->where('consolidados.flg_status', '=', 'A')
        ->orderby('numeroconsolidado', 'DESC')
        ->paginate(20);
        return response()->json($cerA);
    }

    public function popConsolidadoF(){
        $cerA = DB::table('consolidados')
        ->select('consolidados.idConsolidado', 'consolidados.numeroConsolidado', 'consolidados.ciclo', 'consolidados.flg_status', 'consolidados.marca', 'consolidados.sequencia')
        ->where('consolidados.flg_status', '=', 'F')
        ->orderby('numeroconsolidado', 'DESC')
        ->paginate(20);
        return response()->json($cerA);
    }

    public function popPrint($id){
        $print = DB::table('consolidados')
        ->select('consolidados.*', 'empresas.empresa', 'empresas.idEmpresa', 'empresas.endereco', 'empresas.numero', 'empresas.bairro', 'empresas.pais', 'empresas.id_municipio', 'fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.endereco as end_for', 'fornecedores.numero as num_for', 'fornecedores.bairro as bairro_for', 'fornecedores.municipio as munic_for')
        ->where('consolidados.idconsolidado', '=', $id)
        ->join('empresas', 'empresas.idEmpresa', '=', 'consolidados.destinatario')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'consolidados.id_remetente')
        ->get();
        return response()->json($print);
    }

    public function popCertificados($id){
        $pciclo = str_replace('-', '/', $id);
        $ciclo = DB::table('certificados')
        ->select('certificados.*', 'empresas.empresa')
        ->where('ciclo', '=', $pciclo)
        ->join('empresas', 'empresas.idEmpresa', '=', 'certificados.destinatario')
        ->get();
        return response()->json($ciclo);
    }

    public function popConsolidado($id){
        $consolidado = DB::table('certificados')
        ->select('certificados.*', 'comunicados.localTratamento')
        ->where('idCertificado', '=', $id)
        ->join('comunicados', 'comunicados.numeroComunicado', '=', 'certificados.numeroComunicado')
        ->get();
        return response()->json($consolidado);
    }

    public function controleConsolidado(){
        $cc = DB::table('consolidados')
        ->select('ctrlConsolidado')
        ->orderby('ctrlConsolidado', 'DESC')
        ->limit(1)
        ->get();
        return response()->json($cc);
    }
    
    public function adiciona($id){
        $adiciona = DB::table('consolidados')
        ->select('consolidados.idConsolidado', 'consolidados.ciclo', 'consolidados.numeroConsolidado', 'consolidados.qtd', 'consolidados.sequencia')
        ->where('ctrlConsolidado', '=', $id)
        ->get();
        return response()->json($adiciona);
    }

    public function status($id, $ai){
        $status = consolidado::where('idConsolidado', $id)->update(['flg_status' => $ai]);
        return response()->json($status);
    }

    public function editConsolidado($id){
        $edit = DB::table('consolidados')
        ->select('*')
        ->where('idConsolidado', '=', $id)
        ->get();
        return response()->json($edit);
    }

    public function populaCadastro($id){
        $edit = DB::table('consolidados')
        ->select('*')
        ->where('ctrlConsolidado', '=', $id)
        ->get();
        return response()->json($edit);
    }

    public function numConsolidado($id){
        $nc = str_replace('-', '/', $id);
        $edit = DB::table('consolidados')
        ->select('numeroConsolidado', 'sequencia')
        ->where('numeroConsolidado', '=', $nc)
        ->orderby('sequencia', 'DESC')
        ->limit(1)
        ->get();
        return response()->json($edit);
    }

    public function bpCiclo($id){
        $pciclo = str_replace('-', '/', $id);
        $ciclo = DB::table('consolidados')
        ->select('idConsolidado', 'ciclo', 'numeroConsolidado', 'marca', 'sequencia', 'ctrlConsolidado', 'flg_status')
        ->where('ciclo', '=', $pciclo)
        ->get();
        return response()->json($ciclo);
    }

    public function bpFormulario($id){
        $for = DB::table('consolidados')
        ->select('idConsolidado', 'ciclo', 'numeroConsolidado', 'marca', 'sequencia', 'ctrlConsolidado', 'flg_status')
        ->where('ctrlConsolidado', '=', $id)
        ->get();
        return response()->json($for);
    }

    public function bpCertificado($id){
        $pcert = str_replace('-', '/', $id);
        $cert = DB::table('consolidados')
        ->select('idConsolidado', 'ciclo', 'numeroConsolidado', 'marca', 'sequencia', 'ctrlConsolidado', 'flg_status')
        ->where('numeroConsolidado', '=', $pcert)
        ->get();
        return response()->json($cert);
    }
}
