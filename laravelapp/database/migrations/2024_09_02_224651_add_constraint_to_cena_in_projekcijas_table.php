<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintToCenaInProjekcijasTable extends Migration
{
    public function up()
    {
        Schema::table('projekcijas', function (Blueprint $table) {
            $table->decimal('cena', 8, 2)->unsigned()->change();
        });
    }

    public function down()
    {
        Schema::table('projekcijas', function (Blueprint $table) {
            $table->decimal('cena', 8, 2)->change();
        });
    }
}
