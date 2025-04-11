<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::creat('comunicados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idComunicado'); 
            $table->string('numeroComunicado', 100); 
            $table->timestamp('dataComunicado')->useCurrent(); 
            $table->integer('id_estufa')->nullable();
            $table->string('nomePrestador', 250)->default('E2 SERVIÇOS LTDA'); 
            $table->string('cnpj', 18)->default('07.383.955/0001-14');
            $table->string('numCredenciamento', 50)->default('BR/MG 0196');
            $table->integer('id_fornecedor')->nullable();
            $table->string('localTratamento', 250)->default('ESTUFA E2 SERVIÇOS / RUA JOSE LEVINDO VALADARES, 291, VASCO LOPES, PAPAGAIOS - MG - 35669000 / BRASIL');
            $table->string('destino', 150)->default('NÃO SE ENQUADRA');
            $table->string('tratadoDestruido', 1)->nullable();
            $table->string('numDescVolumes', 150)->nullable();
            $table->decimal('quantidade', 12, 3)->nullable(); 
            $table->string('marcas', 250)->nullable();
            $table->string('modalidade', 150)->nullable()->default('AR QUENTE FORÇADO / HIGH TEMPERATURE (HT)');
            $table->date('dataInicio')->nullable();
            $table->time('horaInicio')->nullable();
            $table->string('duracao', 20)->nullable();
            $table->string('temperatura', 20)->nullable();
            $table->string('agrotoxico', 50)->default('NÃO SE ENQUADRA');
            $table->string('ingredienteAtivo', 250)->default('NÃO SE ENQUADRA');
            $table->string('dose', 10)->nullable();
            $table->string('prodComercial', 20)->default('NÃO SE ENQUADRA');
            $table->string('radiacao', 20)->default('NÃO SE ENQUADRA');
            $table->integer('id_engenheiro_1')->nullable();
            $table->integer('id_engenheiro_2')->nullable();
            $table->timestamp('dataAlteracao')->useCurrentOnUpdate();
            $table->string('status', 1)->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('comucicados');
    }
};
