<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->integer('broj_sedista');
            $table->string('lokacija')->nullable();
            $table->string('vrstasale')->nullable();
            $table->text('oprema')->nullable();
            $table->boolean('dostupnost')->default(true);
            $table->text('napomena')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salas');
    }
}
