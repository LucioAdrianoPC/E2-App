<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\comunicado;

class ComunicadoController extends Controller
{
    public function index()
    {
        return comunicado::all();
    }

    public function store(Request $request)
    {
        comunicado::create($request->all());
    }


    public function show(string $id)
    {
        return comunicado::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $comunicado = comunicado::findOrFail($id);
        $comunicado->update($request->all());
    }


    public function destroy(string $id)
    {
        $comunicado = comunicado::findOrFail($id);
        $comunicado->delete();
    }

    public function popCadastro($id){
        $comunicado = DB::table('comunicados')
        ->select('comunicados.*', 'fornecedores.fornecedor', 'fornecedores.cnpj as cnpjfor', 'fornecedores.endereco as end_for', 'fornecedores.numero as num_for', 'fornecedores.bairro as bairro_for', 'fornecedores.cep as cep_for', 'fornecedores.municipio as muni_for')
        ->where('numeroComunicado', '=', $id)
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->get();
        return response()->json($comunicado);
    }

    public function selecionaEmpresa(){
        $empresa = DB::table('empresas')
        ->select('idEmpresa', 'empresa', 'cnpj', 'flg_status')
        ->where('flg_status', '=', 'A')
        ->get();
        return response()->json($empresa);
    }

    public function selecionaEngenheiro(){
        $engenheiro = DB::table('engenheiros')
        ->select('*')
        ->where('flg_status', '=', 'A')
        ->get();
        return response()->json($engenheiro);
    }

    public function buscaEmpresa($id){
        $empresa = DB::table('fornecedores')
        ->select('idFornecedor', 'fornecedor', 'cnpj', 'flg_status')
        ->where('idFornecedor', '=', $id)
        ->get();
        return response()->json($empresa);
    }

    public function buscaEngenheiro($id){
        $engenheiro = DB::table('engenheiros')
        ->select('*')
        ->where('idEngenheiro', '=', $id)
        ->get();
        return response()->json($engenheiro);
    }

    public function popComunicadoA(){
        $comA = DB::table('comunicados')
        ->select('comunicados.idComunicado','comunicados.numeroComunicado', 'comunicados.id_fornecedor', 'fornecedores.fornecedor')
        ->where('status', '=', 'A')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->orderby('numeroComunicado', 'DESC')
        ->paginate(20);
        return response()->json($comA);
    }

    public function popComunicadoC(){
        $comC = DB::table('comunicados')
        ->select('comunicados.idComunicado','comunicados.numeroComunicado', 'comunicados.id_fornecedor', 'fornecedores.fornecedor')
        ->where('status', '=', 'C')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->orderby('numeroComunicado', 'DESC')
        ->paginate(20);
        return response()->json($comC);
    }
    
    public function popComunicadoF(){
        $comF = DB::table('comunicados')
        ->select('comunicados.idComunicado','comunicados.numeroComunicado', 'comunicados.id_fornecedor', 'fornecedores.fornecedor')
        ->where('status', '=', 'F')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->orderby('numeroComunicado', 'DESC')
        ->paginate(20);
        return response()->json($comF);
    }

    public function numeroComunicado(){
        $comF = DB::table('comunicados')
        ->select('numeroComunicado')
        ->orderby('numeroComunicado', 'DESC')
        ->limit(1)
        ->get();
        return response()->json($comF);
    }

    public function selecionaEstufa(){
        $estufas = DB::table('fornecedores')
        ->select('fornecedores.*', 'municipios.*')
        ->where('flg_status', '=', 'A')
        ->join('municipios', 'municipios.idMunicipio', '=', 'fornecedores.municipio')
        ->orderby('idFornecedor', 'ASC')
        ->get();
        return response()->json($estufas);
    }

    public function popEstufa($id){
        $popestufas = DB::table('fornecedores')
        ->select('fornecedores.*', 'municipios.*')
        ->where('flg_status', '=', 'A')
        ->where('fornecedores.idFornecedor', '=', $id)
        ->join('municipios', 'municipios.idMunicipio', '=', 'fornecedores.municipio')
        ->orderby('idFornecedor', 'ASC')
        ->get();
        return response()->json($popestufas);
    }

    public function pesquisarNomeCom($nome){
        $pesquisar = DB::table('comunicados')
        ->select('fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.cnpj', 'comunicados.id_fornecedor', 'comunicados.quantidade', 'comunicados.numeroComunicado', 'comunicados.status')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->where('fornecedores.fornecedor','LIKE',"%{$nome}%")
        ->get();
        return response()->json($pesquisar);
    }

    public function pesquisarNumeroCom($numero){
        $pesquisar = DB::table('comunicados')
        ->select('fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.cnpj', 'comunicados.id_fornecedor', 'comunicados.quantidade', 'comunicados.numeroComunicado')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->where('comunicados.numeroComunicado','LIKE',"%{$numero}%")
        ->get();
        return response()->json($pesquisar);
    }

}
