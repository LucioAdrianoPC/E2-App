<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class engenheiro extends Model
{
    use HasFactory;
    protected $table = 'engenheiros';
    protected $primaryKey = 'idEngenheiro';
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'nome',
        'formacao',
        'crea',
        'flg_status',
        'dataCadastro',
        'dataAlteracao',
    ];
}
