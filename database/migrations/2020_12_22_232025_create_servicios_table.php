<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->decimal("precio", 10, 2)->nullable();
            $table->text("detalle")->nullable();
            $table->bigInteger("establecimiento_id")->unsigned();
            $table->bigInteger("categoria_id")->unsigned();

            $table->foreign("establecimiento_id")->references("id")->on("establecimientos");
            $table->foreign("categoria_id")->references("id")->on("categorias");

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
        Schema::dropIfExists('servicios');
    }
}
