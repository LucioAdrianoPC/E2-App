<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comunicado extends Model
{
    use HasFactory;
    protected $table = 'comunicados';
    protected $primaryKey = 'idComunicado';
    const CREATED_AT = 'dataComunicado';
    const UPDATED_AT = 'dataAlteracao';
    protected $fillable = [
        'numeroComunicado',
        'dataComunicado',
        'id_estufa',
        'nomePrestador',
        'cnpj',
        'numCredenciamento',
        'id_fornecedor',
        'localTratamento',
        'destino',
        'tratadoDestruido',
        'numDescVolumes', 
        'quantidade', 
        'marcas', 
        'modalidade', 
        'dataInicio',
        'horaInicio',
        'duracao',
        'temperatura',
        'agrotoxico',
        'ingredienteAtivo',
        'dose',
        'prodComercial',
        'radiacao',
        'id_engenheiro_1',
        'id_engenheiro_2',
        'dataAlteracao',
        'status'
    ];
}
