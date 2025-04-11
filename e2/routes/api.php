<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cadcomunicados', 'App\Http\Controllers\api\ComunicadoController');

Route::apiResource('cadengenheiros', 'App\Http\Controllers\api\EngenheiroController');

Route::apiResource('cadfornecedores', 'App\Http\Controllers\api\FornecedorController');

Route::apiResource('cadempresas', 'App\Http\Controllers\api\EmpresaController');
Route::get('popempresa/{id}', 'App\Http\Controllers\api\EmpresaController@popCadastro');
Route::get('empresasativas', 'App\Http\Controllers\api\EmpresaController@popEmpresasA');
Route::get('empresasinativas', 'App\Http\Controllers\api\EmpresaController@popEmpresasI');
Route::get('municipioauto/{nome}', 'App\Http\Controllers\api\EmpresaController@municipioAuto');
Route::get('pnome/{texto}', 'App\Http\Controllers\api\EmpresaController@pesquisarNome');
Route::get('pcnpj/{texto}', 'App\Http\Controllers\api\EmpresaController@pesquisarCNPJ');
Route::get('existecnpj/{texto}', 'App\Http\Controllers\api\EmpresaController@existeCNPJ');
Route::put('ai/{id}/{situacao}', 'App\Http\Controllers\api\EmpresaController@ativaInativa');
Route::get('https://receitaws.com.br/v1/cnpj', ['middleware' => 'cors']);

Route::apiResource('cadunidademedida', 'App\Http\Controllers\api\UnidadeMedidaController');

Route::get('estados', 'App\Http\Controllers\api\MunicipioController@estado');
Route::get('municipios/{idEstado}', 'App\Http\Controllers\api\MunicipioController@municipio');
Route::get('cep/{cep}', 'App\Http\Controllers\api\MunicipioController@cep');

Route::apiResource('cadfornecedor', 'App\Http\Controllers\api\FornecedorController');
Route::get('popfornecedor/{id}', 'App\Http\Controllers\api\FornecedorController@popCadastro');
Route::get('fornecedoresativos', 'App\Http\Controllers\api\FornecedorController@popFornecedoresA');
Route::get('fornecedoresinativos', 'App\Http\Controllers\api\FornecedorController@popFornecedoresI');
Route::get('pnomefor/{texto}', 'App\Http\Controllers\api\FornecedorController@pesquisarNome');
Route::get('pcnpjfor/{texto}', 'App\Http\Controllers\api\FornecedorController@pesquisarCNPJ');
Route::get('existecnpjf/{texto}', 'App\Http\Controllers\api\FornecedorController@existeCNPJ');
Route::put('aifor/{id}/{situacao}', 'App\Http\Controllers\api\FornecedorController@ativaInativa');
Route::get('estufae2', 'App\Http\Controllers\api\FornecedorController@estufaE2');

Route::apiResource('cadengenheiro', 'App\Http\Controllers\api\EngenheiroController');
Route::get('popengenheiro/{id}', 'App\Http\Controllers\api\EngenheiroController@popCadastro');
Route::get('engenheirosativos', 'App\Http\Controllers\api\EngenheiroController@popEngenheirosA');
Route::get('engenheirosinativos', 'App\Http\Controllers\api\EngenheiroController@popEngenheirosI');
Route::get('pnomeen/{texto}', 'App\Http\Controllers\api\EngenheiroController@pesquisarNome');
Route::put('aien/{id}/{situacao}', 'App\Http\Controllers\api\EngenheiroController@ativaInativa');

Route::apiResource('cadcomunicado', 'App\Http\Controllers\api\ComunicadoController');
Route::get('popcomunicado/{id}', 'App\Http\Controllers\api\ComunicadoController@popCadastro');
Route::get('comunicadosa', 'App\Http\Controllers\api\ComunicadoController@popComunicadoA');
Route::get('comunicadosc', 'App\Http\Controllers\api\ComunicadoController@popComunicadoC');
Route::get('comunicadosf', 'App\Http\Controllers\api\ComunicadoController@popComunicadoF');
Route::get('pnomeen/{texto}', 'App\Http\Controllers\api\ComunicadoController@pesquisarNome');
Route::put('aicom/{id}/{situacao}', 'App\Http\Controllers\api\ComunicadoController@ativaInativa');
Route::get('selecionaempresa', 'App\Http\Controllers\api\ComunicadoController@selecionaEmpresa');
Route::get('selecionaestufa', 'App\Http\Controllers\api\ComunicadoController@selecionaEstufa');
Route::get('popestufa/{id}', 'App\Http\Controllers\api\ComunicadoController@popEstufa');
Route::get('selecionaengenheiro', 'App\Http\Controllers\api\ComunicadoController@selecionaEngenheiro');
Route::get('buscaempresa/{id}', 'App\Http\Controllers\api\ComunicadoController@buscaEmpresa');
Route::get('buscaengenheiro/{id}', 'App\Http\Controllers\api\ComunicadoController@buscaEngenheiro');
Route::get('numerocomunicado', 'App\Http\Controllers\api\ComunicadoController@numeroComunicado');
Route::get('pncom/{nome}', 'App\Http\Controllers\api\ComunicadoController@pesquisarNomeCom');
Route::get('pnumerocom/{numero}', 'App\Http\Controllers\api\ComunicadoController@pesquisarNumeroCom');

Route::apiResource('cadcertificado', 'App\Http\Controllers\api\CertificadoController');

Route::get('geracertificado/{id}', 'App\Http\Controllers\api\CertificadoController@popCadastro');
Route::get('popcertificado/{id}', 'App\Http\Controllers\api\CertificadoController@popCertificado');
Route::get('popdestinatario/{id}', 'App\Http\Controllers\api\CertificadoController@popDestinatario');
Route::get('popfilho/{id}', 'App\Http\Controllers\api\CertificadoController@popFilho');
Route::get('geranumerofilho/{id}', 'App\Http\Controllers\api\CertificadoController@geraNumeroFilho');
Route::get('somafilhos/{nc}', 'App\Http\Controllers\api\CertificadoController@somaFilhos');
Route::get('unidade', 'App\Http\Controllers\api\CertificadoController@popUnidade');
Route::get('empresas', 'App\Http\Controllers\api\CertificadoController@popEmpresas');
Route::get('fornecedores', 'App\Http\Controllers\api\CertificadoController@popEstufas');
Route::get('destino/{id}', 'App\Http\Controllers\api\CertificadoController@popDestino');
Route::get('certificadosa', 'App\Http\Controllers\api\CertificadoController@popCertificadoA');
Route::get('certificadosf', 'App\Http\Controllers\api\CertificadoController@popCertificadoF');
Route::get('printcertificado/{id}', 'App\Http\Controllers\api\CertificadoController@popPrint');
Route::get('buscamunicipio/{id}', 'App\Http\Controllers\api\CertificadoController@buscaMunicipio');
Route::get('buscadestinatario/{id}', 'App\Http\Controllers\api\CertificadoController@buscaDestinatario');
Route::get('loteciclo/{id}', 'App\Http\Controllers\api\CertificadoController@loteCiclo');
Route::get('pnc/{nome}', 'App\Http\Controllers\api\CertificadoController@pesquisarNomeCer');
Route::get('pnumero/{numero}', 'App\Http\Controllers\api\CertificadoController@pesquisarNumeroCer');
Route::get('lid/{numero}', 'App\Http\Controllers\api\CertificadoController@localizaId');
Route::get('local/{id}', 'App\Http\Controllers\api\CertificadoController@local');

/*Usuários*/ 
Route::apiResource('usuario', 'App\Http\Controllers\api\UsuarioController');

Route::apiResource('cadconsolidado', 'App\Http\Controllers\api\ConsolidadoController');


Route::get('consolidadosa', 'App\Http\Controllers\api\ConsolidadoController@popConsolidadoA');
Route::get('consolidadosf', 'App\Http\Controllers\api\ConsolidadoController@popConsolidadoF');
Route::get('printconsolidado/{id}', 'App\Http\Controllers\api\ConsolidadoController@popPrint');
Route::get('enderecoremetente/{id}', 'App\Http\Controllers\api\ConsolidadoController@enderecoEmpresa');
Route::get('popcertificados/{id}', 'App\Http\Controllers\api\ConsolidadoController@popCertificados');
Route::get('popremetente', 'App\Http\Controllers\api\ConsolidadoController@popRemetente');
Route::get('popconsolidado/{id}', 'App\Http\Controllers\api\ConsolidadoController@popConsolidado');
Route::get('ctrlconsolidado', 'App\Http\Controllers\api\ConsolidadoController@controleConsolidado');
Route::get('adiciona/{id}', 'App\Http\Controllers\api\ConsolidadoController@adiciona');
Route::put('status/{id}/{situacao}', 'App\Http\Controllers\api\ConsolidadoController@status');
Route::get('editconsolidado/{id}', 'App\Http\Controllers\api\ConsolidadoController@editConsolidado');
Route::get('populacadastro/{id}', 'App\Http\Controllers\api\ConsolidadoController@populaCadastro');
Route::get('bpciclo/{id}', 'App\Http\Controllers\api\ConsolidadoController@bpCiclo');
Route::get('bpformulario/{id}', 'App\Http\Controllers\api\ConsolidadoController@bpFormulario');
Route::get('bpcertificado/{id}', 'App\Http\Controllers\api\ConsolidadoController@bpCertificado');
Route::get('nc/{id}', 'App\Http\Controllers\api\ConsolidadoController@numConsolidado');