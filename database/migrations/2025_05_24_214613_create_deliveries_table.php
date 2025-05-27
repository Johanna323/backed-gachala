<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->constrained('beneficiaries')->onDelete('cascade');
            $table->foreignId('kit_id')->constrained('kit_inventories')->onDelete('cascade');
            $table->timestamp('fecha_entrega')->useCurrent();
            $table->foreignId('funcionario_entrega')->nullable()->constrained('users')->onDelete('set null');
            $table->text('observaciones')->nullable();
            $table->string('estado', 20)->default('pendiente');
            $table->unsignedBigInteger('sector_id')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
