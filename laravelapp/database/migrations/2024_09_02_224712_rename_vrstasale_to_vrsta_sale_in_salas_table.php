<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameVrstasaleToVrstaSaleInSalasTable extends Migration
{
    public function up()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->renameColumn('vrstasale', 'vrsta_sale');
        });
    }

    public function down()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->renameColumn('vrsta_sale', 'vrstasale');
        });
    }
}
