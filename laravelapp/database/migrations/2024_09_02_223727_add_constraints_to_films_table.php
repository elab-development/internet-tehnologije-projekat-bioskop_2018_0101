<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToFilmsTable extends Migration
{
    public function up()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('naziv')->nullable(false)->change();
            $table->string('zanr')->nullable(false)->change();
            $table->integer('trajanje')->nullable(false)->change();
            $table->string('reziser')->nullable(false)->change();
            $table->integer('godina_izdanja')->unsigned()->nullable(false)->change();
            $table->string('jezik')->nullable(false)->change();
            $table->decimal('ocena', 3, 2)->nullable(false)->change();
            $table->string('poster_url')->nullable()->default('default_poster.jpg')->change();
            $table->string('trailer_url')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('naziv')->nullable()->change();
            $table->string('zanr')->nullable()->change();
            $table->integer('trajanje')->nullable()->change();
            $table->string('reziser')->nullable()->change();
            $table->integer('godina_izdanja')->nullable()->change();
            $table->string('jezik')->nullable()->change();
            $table->decimal('ocena', 3, 2)->nullable()->change();
            $table->string('poster_url')->nullable()->change();
            $table->string('trailer_url')->nullable()->change();
        });
    }
}
