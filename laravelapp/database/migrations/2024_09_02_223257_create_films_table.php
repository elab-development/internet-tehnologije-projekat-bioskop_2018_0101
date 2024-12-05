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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('zanr');
            $table->integer('trajanje');
            $table->text('opis')->nullable();
            $table->string('reziser')->nullable();
            $table->text('glumci')->nullable();
            $table->integer('godina_izdanja')->nullable();
            $table->string('jezik')->nullable();
            $table->decimal('ocena', 3, 2)->nullable();
            $table->string('poster_url')->nullable();
            $table->string('trailer_url')->nullable();
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
        Schema::dropIfExists('films');
    }
};
