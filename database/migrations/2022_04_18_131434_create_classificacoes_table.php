<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classificacoes', function (Blueprint $table) {
            $table->id();
            $table->text('resolucao');
            // $table->string('caminho_img')->nullable()->default(NULL);
            $table->bigInteger('freq');
            $table->foreignId('ocorrencia_id')->constrained();

            // $table->foreignId('classificacoes_id')->references('id')->on('ocorrencias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classificacoes');
    }
}
