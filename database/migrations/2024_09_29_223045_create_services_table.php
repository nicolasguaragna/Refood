<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del servicio
            $table->text('description'); // Descripción del servicio
            $table->string('type'); // Tipo de servicio (S, M, L, XL)
            $table->decimal('contribution', 8, 2)->nullable(); // Contribución económica (si aplica)
            $table->integer('minimum_kg')->nullable(); // Cantidad mínima de alimentos
            $table->string('logistics_required')->nullable(); // Si se necesita logística especial
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
