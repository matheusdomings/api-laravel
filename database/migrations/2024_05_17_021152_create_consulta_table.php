<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proc_id');
            $table->unsignedBigInteger('med_id');
            $table->uuid('cons_codigo');
            $table->string('data');
            $table->string('hora');
            $table->string('particu1lar')->default('0');
            $table->timestamps();

            $table->foreign('med_id')->references('id')->on('medico')->onDelete('cascade');
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
        Schema::dropIfExists('consulta');
    }
}
