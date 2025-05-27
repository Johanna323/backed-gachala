<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kit_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_kit', 100);
            $table->text('descripcion')->nullable();
            $table->integer('cantidad_disponible');
            $table->timestamp('fecha_actualizacion')->useCurrent();
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
        Schema::dropIfExists('kit_inventories');
    }
}
