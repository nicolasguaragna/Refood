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
            $table->id();
            $table->string('donor_name'); // Nombre del donante o patrocinador
            $table->decimal('amount', 8, 2); // Monto donado o patrocinado
            $table->string('payment_method'); // Mercado Pago o transferencia
            $table->string('transaction_id')->nullable(); // ID de transacción (si aplica)
            $table->string('type'); // donation o sponsorship
            $table->timestamps();
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
