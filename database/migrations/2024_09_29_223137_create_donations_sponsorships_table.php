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
        Schema::create('donations_sponsorships', function (Blueprint $table) {
            $table->id('donations_sponsorships_id');
            $table->string('donor_name'); // Nombre del donante o patrocinador
            $table->decimal('amount', 8, 2); // Monto donado o patrocinado
            $table->string('payment_method'); // Mercado Pago o transferencia
            $table->string('transaction_id')->nullable(); // ID de transacción, útil para seguimiento o auditoría.
            $table->string('type'); // Indica si es una "donación" o "patrocinio".
            $table->timestamps(); //método generado automaticamente, define create_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations_sponsorships');
    }
};
