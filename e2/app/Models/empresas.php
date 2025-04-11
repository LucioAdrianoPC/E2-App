<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresas extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $primaryKey = 'idEmpresa';
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'idEmpresa',
        'empresa',
        'cnpj',
        'ie',
        'endereco', 
        'numero', 
        'bairro',
        'cep',
        'pais',
        'telefone1',
        'telefone2',
        'email', 
        'valor', 
        'contato',
        'observacao',
        'flg_status',
        'flg_fechamento', 
        'dataCadastro',
        'dataAlteracao',
        'id_municipio',
        'engenheiro_id'
    ];
}
