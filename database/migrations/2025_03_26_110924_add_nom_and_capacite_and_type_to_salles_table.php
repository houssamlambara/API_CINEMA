<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomAndCapaciteAndTypeToSallesTable extends Migration
{
    public function up()
    {
        Schema::table('salles', function (Blueprint $table) {
            $table->string('type')->nullable();  
        });
    }

    public function down()
    {
        Schema::table('salles', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
}
