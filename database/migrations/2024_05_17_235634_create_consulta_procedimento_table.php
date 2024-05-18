<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaProcedimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_procedimento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cons_id');
            $table->unsignedBigInteger('proc_id');
            $table->timestamps();
            $table->foreign('cons_id')->references('id')->on('consulta')->onDelete('cascade');
            $table->foreign('proc_id')->references('id')->on('procedimento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consulta_procedimento');
    }
}
