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
        Schema::create('certificados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idCertificado'); 
            $table->integer('numeroCertificado'); 
            $table->integer('numeroFilho');
            $table->integer('numeroComunicado'); 
            $table->date('dataEmissao'); 
            $table->string('pesoBruto', 20)->nullable(); 
            $table->string('origem', 150); 
            $table->string('destino', 150);
            $table->text('marca');
            $table->string('qtdVolume', 150);
            $table->text('numeroDosCtrs');
            $table->text('natProduto');
            $table->integer('qtd');
            $table->text('destinatario');
            $table->string('navio', 100);
            $table->string('produtoUtilizado', 150);
            $table->date('dataExpurgo');
            $table->date('dataTerminoExpurgo');
            $table->string('tempTratamento', 10);
            $table->string('tempoExposicao', 30); 
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->string('temperatura', 20);
            $table->string('observacoes', 250)->nullable();
            $table->string('frase', 200)->default('Only the wooden creates (Pallets) have been trated');
            $table->string('flg_status', 1);
            $table->string('flg_type', 1);
            $table->string('flg_visivel', 1);
            $table->timestamp('dataCadastro')->useCurrent();
            $table->timestamp('dataAlteracao')->useCurrentOnUpdate();
            $table->string('lote', 100);
            $table->string('ciclo', 100);
            $table->string('id_unidade_medida', 10);
            $table->integer('id_remetente')->nullable();
            $table->integer('id_estufa')->nullable();
            $table->integer('id_engenheiro')->nullable();
            $table->string('id_mae', 50)->nullable();
            $table->string('id_filhote')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('certificados');
    }
};
