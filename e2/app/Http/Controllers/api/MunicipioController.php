<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MunicipioController extends Controller
{
    public function estado(){
                
        $estados = DB::table('estado')
        ->select('idEstado', 'uf')
        ->orderby('uf', 'ASC')
        ->get();
        return response()->json($estados);
    }

    public function municipio($id){
                
        $municipios = DB::table('municipios')
        ->select('idMunicipio', 'nomeMunicipio', 'ufMunicipio', 'cep', 'pais')
        ->where('id_estado', '=', $id)
        ->orderby('nomeMunicipio', 'ASC')
        ->get();
        return response()->json($municipios);
    }

    public function cep($id){
                
        $cepMunicipio = DB::table('municipios')
        ->select('idMunicipio', 'nomeMunicipio', 'ufMunicipio', 'cep', 'pais')
        ->where('cep', '=', '$cep')
        ->get();
        return response()->json($cepMunicipio);
    }
}
