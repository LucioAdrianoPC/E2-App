<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fornecedor extends Model
{
    use HasFactory;
    protected $table = 'fornecedores';
    protected $primaryKey = 'idFornecedor';
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'fornecedor',
        'cnpj',
        'ie',
        'endereco', 
        'numero', 
        'bairro',
        'cep',
        'municipio',
        'pais',
        'telefone1',
        'telefone2',
        'email', 
        'contato',
        'numCredenciamento',
        'e2',
        'observacao',
        'flg_status',
        'dataCadastro',
        'dataAlteracao',
    
    ];
}
