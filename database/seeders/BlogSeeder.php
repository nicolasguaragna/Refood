<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_posts')->insert([
            [
                'title' => 'Primera Entrada del Blog',
                'content' => 'Este es el contenido de la primera entrada del blog.',
                'author_id' => 1, // ID de un usuario autor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Segunda Entrada del Blog',
                'content' => 'Este es el contenido de la segunda entrada del blog.',
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cómo reducir el desperdicio alimentario en casa',
                'content' => 'En este artículo, exploramos formas sencillas de reducir el desperdicio de alimentos en el hogar, incluyendo la planificación de comidas y el almacenamiento adecuado de alimentos.',
                'author_id' => 3, // ID de un usuario autor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'La importancia de los comedores comunitarios',
                'content' => 'Los comedores comunitarios juegan un papel vital en el alivio del hambre. Aquí analizamos cómo funcionan y su impacto en las comunidades más vulnerables.',
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
