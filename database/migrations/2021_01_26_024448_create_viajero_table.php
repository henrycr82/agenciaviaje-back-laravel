<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajeros', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula')->unique();
            $table->string('nombre', 50);
            $table->date('fecha_nacimiento');
            $table->string('telefono',13);
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
        Schema::dropIfExists('viajeros');
    }
}
