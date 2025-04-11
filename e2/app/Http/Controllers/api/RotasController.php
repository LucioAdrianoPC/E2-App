<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RotasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comunicado(){
        return view('comunicado');
    }

    public function cadcom($id){
        return view('cadcom');
    }

    public function engenheiro(){
        return view('engenheiro');
    }

    public function cadengenheiro($id){
        return view('cadengenheiro');
    }

    public function fornecedor(){
        return view('fornecedor');
    }

    public function cadfor($id){
        return view('cadfor');
    }

    public function empresa(){
        return view('empresa');
    }

    public function cadempresa($id){
        return view('cadempresa');
    }

    public function printcomunicado($id){
        return view('printcomunicado');
    }

    public function certificado(){
        return view('certificado');
    }

    public function cadcertificado($id){
        return view('cadcertificado');
    }

    public function printcertificado($id){
        return view('printcertificado');
    }

    public function usuarios(){
        return view('usuarios');
    }

    public function CadUsuarios($id){
        return view('cadusuario');
    }

    public function consolidado(){
        return view('consolidado');
    }

    public function cadconsolidado($id){
        return view('cadconsolidado');
    }

    public function editconsolidado($id){
        return view('editconsolidado');
    }

    public function printconsolidado($id){
        return view('printconsolidado');
    }
}
