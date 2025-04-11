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
        Schema::create('empresas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idEmpresa'); 
            $table->string('empresa', 100); 
            $table->string('cnpj', 18)->nullable(); 
            $table->string('ie', 30)->nullable(); 
            $table->string('endereco', 100)->nullable(); 
            $table->string('numero', 50)->nullable(); 
            $table->string('bairro', 100)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('pais', 20)->nullable();
            $table->string('telefone1', 14);
            $table->string('telefone2', 14)->nullable();
            $table->string('email', 200); 
            $table->double('valor', 12, 2)->nullable(); 
            $table->string('contato', 50)->nullable();
            $table->string('observacao', 250)->nullable();
            $table->string('flg_status', 1);
            $table->string('flg_fechamento', 1);
            $table->timestamp('dataCadastro')->useCurrent();
            $table->timestamp('dataAlteracao')->useCurrentOnUpdate();
            $table->integer('id_municipio');
            $table->integer('engenheiro_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('empresas');
    }
};
