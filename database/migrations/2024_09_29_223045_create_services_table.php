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
            $table->id('service_id'); //método generado automaticamente
            $table->string('name'); // Nombre del servicio (ej, rescate A)
            $table->text('description'); // Descripción del servicio
            $table->string('type'); // Tipo de servicio  Para identificar si es un rescate pequeño, mediano, grande, o un programa de apoyo.
            $table->decimal('contribution', 8, 2)->nullable(); // Contribución económica, Un bono económico que algunas categorías de rescates requieren para cubrir logística.
            $table->integer('minimum_kg')->nullable(); // Cantidad mínima de kg de alimentos,dependiendo el rescate.
            $table->string('logistics_required')->nullable(); // Si se necesita logística especial (por ejemplo, kits de recolección).
            $table->timestamps(); //método generado automaticamente, define create_at y updated_at
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
