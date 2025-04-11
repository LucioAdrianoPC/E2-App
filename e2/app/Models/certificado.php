<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificado extends Model
{
    use HasFactory;
    protected $table = 'certificados';
    protected $primaryKey = 'idCertificado';
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'numeroCertificado', 
        'numeroFilho',
        'numeroComunicado', 
        'dataEmissao',
        'pesoBruto',
        'origem', 
        'destino',
        'marca',
        'qtdVolume',
        'numeroDosCtrs',
        'natProduto',
        'qtd',
        'destinatario',
        'navio',
        'produtoUtilizado',
        'dataExpurgo',
        'dataTerminoExpurgo',
        'tempTratamento',
        'tempoExposicao',
        'horaInicio',
        'horaFim',
        'temperatura',
        'observacoes',
        'frase',
        'flg_status',
        'flg_type',
        'flg_visivel',
        'dataCadastro',
        'dataAlteracao',
        'lote',
        'ciclo',
        'id_unidade_medida',
        'id_remetente',
        'id_estufa',
        'id_engenheiro',
        'id_mae',
        'id_filhote'
    ];
}
