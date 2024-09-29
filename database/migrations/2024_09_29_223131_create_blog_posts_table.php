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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id('blog_posts_id');//método generado automaticamente
            $table->string('title'); // Título del post
            $table->text('content'); // Contenido del post
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // ID del autor, que es una clave foránea relacionada con la tabla de users, lo que permite identificar al usuario que escribió el post.
            $table->timestamps();//método generado automaticamente, define create_at y updated_at
        });
    }

//Esta tabla permite almacenar el contenido de las publicaciones, 
//así como su autoría y fechas de creación/modificación. Esto es ideal 
//para implementar un sistema de gestión de blogs donde varios usuarios 
//pueden publicar artículos relacionados con los objetivos y logros de Refood.

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
