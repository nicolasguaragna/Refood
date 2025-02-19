<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rescue_requests', function (Blueprint $table) {
            $table->string('status')->default('Pendiente'); // Agregar con valor predeterminado
        });
    }

    public function down()
    {
        Schema::table('rescue_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
