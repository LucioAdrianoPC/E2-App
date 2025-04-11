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
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idFornecedor'); 
            $table->string('fornecedor', 100); 
            $table->string('cnpj', 18)->nullable(); 
            $table->string('ie', 30)->nullable(); 
            $table->string('endereco', 100)->nullable(); 
            $table->string('numero', 50)->nullable(); 
            $table->string('bairro', 100)->nullable();
            $table->integer('municipio');
            $table->string('cep', 9)->nullable();
            $table->string('telefone1', 14)->nullable();
            $table->string('telefone2', 14)->nullable();
            $table->string('email', 200); 
            $table->string('contato', 50)->nullable();
            $table->string('numCredenciamento', 150)->nullable();
            $table->integer('e2');
            $table->string('observacao', 250)->nullable();
            $table->string('flg_status', 1);
            $table->timestamp('dataCadastro')->useCurrent();
            $table->timestamp('dataAlteracao')->useCurrentOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('fornecedors');
    }
};
