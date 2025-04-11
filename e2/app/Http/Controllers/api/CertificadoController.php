<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\certificado;

class CertificadoController extends Controller
{
    public function index()
    {
        return certificado::all();
    }

    public function store(Request $request)
    {
        certificado::create($request->all());
    }


    public function show(string $id)
    {
        return certificado::findOrFail($id);
    }


    public function update(Request $request, string $id)
    {
        $certificado = certificado::findOrFail($id);
        $certificado->update($request->all());
    }


    public function destroy(string $id)
    {
        $certificado = certificado::findOrFail($id);
        $certificado->delete();
    }
    
    /*public function popCadastro($id){
        $comunicado = DB::table('comunicados')
        ->select('comunicados.*', 'empresas.*', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('numeroComunicado', '=', $id)
        ->join('empresas', 'empresas.idEmpresa', '=', 'comunicados.id_fornecedor')
        ->join('municipios', 'municipios.idMunicipio', '=', 'empresas.id_municipio')
        ->get();
        return response()->json($comunicado);
    }*/
    public function popCadastro($id){
        $comunicado = DB::table('comunicados')
        ->select('comunicados.*', 'fornecedores.*', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('numeroComunicado', '=', $id)
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'comunicados.id_fornecedor')
        ->join('municipios', 'municipios.idMunicipio', '=', 'fornecedores.municipio')
        ->get();
        return response()->json($comunicado);
    }

    public function popCertificado($id){
        $comunicado = DB::table('certificados')
        ->select('certificados.*', 'empresas.idEmpresa', 'empresas.empresa', 'engenheiros.*')
        ->where('certificados.idCertificado', '=', $id)
        ->join('empresas', 'empresas.idEmpresa', '=', 'certificados.id_remetente')
        ->join('engenheiros', 'engenheiros.idEngenheiro', '=', 'certificados.id_engenheiro')
        ->get();
        return response()->json($comunicado);
    }

    public function popDestinatario($id){
        $destinatario = DB::table('empresas')
        ->select('idEmpresa', 'empresa')
        ->where('idEmpresa', '=', $id)
        ->get();
        return response()->json($destinatario);
    }

    public function popUnidade(){
        $unidade = DB::table('unidades_medidas')
        ->select('*')
        ->get();
        return response()->json($unidade);
    }

    public function popEmpresas(){
        $empresasA = DB::table('empresas')
        ->select('empresas.idEmpresa', 'empresas.empresa', 'empresas.cnpj', 'empresas.id_municipio', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('flg_status', '=', 'A')
        ->join('municipios', 'municipios.idMunicipio', '=', 'empresas.id_municipio')
        ->orderby('empresa', 'ASC')
        ->get();
        return response()->json($empresasA);
    }

    public function popEstufas(){
        $empresasA = DB::table('fornecedores')
        ->select('fornecedores.*', 'fornecedores.municipio', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('flg_status', '=', 'A')
        ->join('municipios', 'municipios.idMunicipio', '=', 'fornecedores.municipio')
        ->orderby('fornecedor', 'ASC')
        ->get();
        return response()->json($empresasA);
    }

    public function popDestino($id){
        $popDestino = DB::table('empresas')
        ->select('empresas.idEmpresa', 'empresas.empresa', 'empresas.id_municipio', 'municipios.nomeMunicipio', 'municipios.ufMunicipio')
        ->where('idEmpresa', '=', $id)
        ->join('municipios', 'municipios.idMunicipio', '=', 'empresas.id_municipio')
        ->get();
        return response()->json($popDestino);
    }

    public function popCertificadoA(){
        $cerA = DB::table('certificados')
        ->select('certificados.idCertificado','certificados.numeroComunicado', 'certificados.numeroCertificado', 'certificados.qtd', 'certificados.flg_status', 'certificados.id_remetente', 'certificados.id_mae', 'fornecedores.fornecedor')
        ->where('certificados.flg_status', '=', 'A')
        ->where('certificados.id_mae', '=', '0')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.destinatario')
        ->orderby('numeroCertificado', 'DESC')
        ->paginate(20);
        return response()->json($cerA);
    }

    public function popCertificadoF(){
        $cerF = DB::table('certificados')
        ->select('certificados.idCertificado','certificados.numeroComunicado', 'certificados.numeroCertificado', 'certificados.qtd', 'certificados.flg_status', 'certificados.id_remetente', 'certificados.id_mae', 'fornecedores.fornecedor')
        ->where('certificados.flg_status', '=', 'F')
        ->where('certificados.id_mae', '=', '0')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.destinatario')
        ->orderby('numeroCertificado', 'DESC')
        ->paginate(20);
        return response()->json($cerF);
    }

    public function popFilho($nc){
        $filho = DB::table('certificados')
        ->select('certificados.idCertificado', 'certificados.numeroCertificado', 'certificados.numeroFilho', 'certificados.qtd', 'certificados.destinatario', 'certificados.id_mae', 'empresas.empresa')
        ->where('certificados.numeroCertificado', '=', $nc)
        ->where('certificados.numeroFilho', '>', '0')
        ->join('empresas', 'empresas.idEmpresa', '=', 'certificados.destinatario')
        ->orderby('numeroFilho', 'DESC')
        ->get();
        return response()->json($filho);
    }

    public function geraNumeroFilho($nc){
        $numerofilho = DB::table('certificados')
        ->select('certificados.idCertificado', 'certificados.numeroCertificado', 'certificados.numeroFilho', 'certificados.qtd', 'certificados.id_mae')
        ->where('certificados.numeroCertificado', '=', $nc)
        ->orderby('certificados.numeroFilho', 'DESC')
        ->limit(1)
        ->get();
        return response()->json($numerofilho);
    }

    public function popPrint($id){
        $print = DB::table('certificados')
        ->select('certificados.*', 'empresas.empresa', 'empresas.idEmpresa', 'empresas.endereco', 'empresas.numero', 'empresas.bairro', 'empresas.pais', 'empresas.id_municipio', 'fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.endereco as end_for', 'fornecedores.numero as num_for', 'fornecedores.bairro as bairro_for', 'fornecedores.municipio as munic_for')
        ->where('certificados.idCertificado', '=', $id)
        ->join('empresas', 'empresas.idEmpresa', '=', 'certificados.destinatario')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.id_remetente')
        ->get();
        return response()->json($print);
    }

    public function local($id){
        $local = DB::table('comunicados')
        ->select('idComunicado', 'localTratamento')
        ->where('numeroComunicado', '=', $id)
        ->get();
        return response()->json($local);
    }

    public function popPrintMae($id){
        $print = DB::table('certificados')
        ->select('certificados.*', 'fornecedores.*')
        ->where('certificados.idCertificado', '=', $id)
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.id_fornecedor')
        ->get();
        return response()->json($print);
    }

    public function buscaMunicipio($id){
        $municipio = DB::table('municipios')
        ->select('*')
        ->where('idMunicipio', '=', $id)
        ->get();
        return response()->json($municipio);
    }

    public function buscaDestinatario($id){
        $dest = DB::table('empresas')
        ->select('empresas.*', 'municipios.*')
        ->where('empresas.idEmpresa', '=', $id)
        ->join('municipios', 'municipios.idMunicipio', '=', 'empresas.id_municipio')
        ->get();
        return response()->json($dest);
    }

    public function somaFilhos($nc){
        $soma = DB::table('certificados')
        ->select('numeroCertificado', 'numeroFilho', \DB::raw('sum(qtd) as total'))
        ->where('numeroFilho', '>', 0)
        ->where('numeroCertificado', '=', $nc)
        ->get();
        return response()->json($soma);
    }

    public function loteCiclo($id){
        $ciclo = DB::table('certificados')
        ->select('lote', 'ciclo')
        ->where('idCertificado', '=', $id)
        ->get();
        return response()->json($ciclo);
    }

    public function pesquisarNomeCer($nome){
        $pesquisar = DB::table('certificados')
        ->select('fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.cnpj', 'certificados.destinatario', 'certificados.id_mae', 'certificados.qtd', 'certificados.numeroCertificado')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.destinatario')
        ->where('certificados.id_mae', '=', 0)
        ->where('fornecedores.fornecedor','LIKE',"%{$nome}%")
        ->get();
        return response()->json($pesquisar);
    }

    public function pesquisarNumeroCer($numero){
        $pesquisar = DB::table('certificados')
        ->select('fornecedores.idFornecedor', 'fornecedores.fornecedor', 'fornecedores.cnpj', 'certificados.destinatario', 'certificados.id_mae', 'certificados.qtd', 'certificados.numeroCertificado')
        ->join('fornecedores', 'fornecedores.idFornecedor', '=', 'certificados.destinatario')
        ->where('certificados.id_mae', '=', 0)
        ->where('certificados.numeroCertificado','LIKE',"%{$numero}%")
        ->get();
        return response()->json($pesquisar);
    }

    public function localizaId($numero){
        $lid = DB::table('comunicados')
        ->select('idComunicado', 'numeroComunicado')
        ->where('numeroComunicado', '=', $numero)
        ->get();
        return response()->json($lid);
    }
      
}
