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
            $table->uuid('cons_codigo');
            $table->unsignedBigInteger('pac_id');
            $table->unsignedBigInteger('med_id');
            $table->unsignedBigInteger('vinculo_id')->nullable();
            $table->string('data');
            $table->string('hora');
            $table->string('particular')->default('0');
            $table->timestamps();

            $table->foreign('pac_id')->references('id')->on('paciente')->onDelete('cascade');
            $table->foreign('med_id')->references('id')->on('medico')->onDelete('cascade');
            $table->foreign('vinculo_id')->references('id')->on('vinculo')->onDelete('cascade');
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
