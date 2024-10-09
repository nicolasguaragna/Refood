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
            ],
            [
                'title' => 'Técnicas para una alimentación saludable',
                'content' => 'En este artículo, exploramos diversas técnicas para mejorar tu alimentación diaria sin hacer grandes sacrificios.',
                'author_id' => 4, // Nicolas Guaragna
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Recetas rápidas y saludables para el día a día',
                'content' => 'Te presentamos una colección de recetas rápidas que no solo son saludables sino también deliciosas.',
                'author_id' => 4, // Nicolas Guaragna
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'El impacto del desperdicio alimentario en el medio ambiente',
                'content' => 'El desperdicio de alimentos tiene un gran impacto en el medio ambiente. En este artículo analizamos cómo reducirlo.',
                'author_id' => 4, // Nicolas Guaragna
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Beneficios del reciclaje en la industria alimentaria',
                'content' => 'En este artículo, discutimos los beneficios que el reciclaje puede tener en la reducción de residuos dentro de la industria alimentaria.',
                'author_id' => 4, // Nicolas Guaragna
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cómo reducir el uso de plásticos en el hogar',
                'content' => 'Reducir el uso de plásticos es esencial para el medio ambiente. Aquí te contamos cómo hacerlo desde casa.',
                'author_id' => 4, // Nicolas Guaragna
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
