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
        Schema::create('engenheiros', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idEngenheiro');
            $table->string('nome', 100);
            $table->string('formacao', 50);
            $table->string('crea', 20);
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
        //Schema::dropIfExists('engenheiros');
    }
};
