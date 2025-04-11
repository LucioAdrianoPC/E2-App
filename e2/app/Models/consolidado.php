<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consolidado extends Model
{
    use HasFactory;
    protected $table = 'consolidados';
    protected $primaryKey = 'idConsolidado';
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'numeroConsolidado', 
        'invoice',
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
        'remetente',
        'estufa',
        'id_engenheiro',
        'id_mae',
        'ctrlConsolidado',
        'sequencia'
    ];
}
