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
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cómo reducir el desperdicio alimentario en casa',
                'content' => 'En este artículo, exploramos formas sencillas de reducir el desperdicio de alimentos en el hogar, incluyendo la planificación de comidas y el almacenamiento adecuado de alimentos.',
                'author_id' => 2, // ID de un usuario autor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'La importancia de los comedores comunitarios',
                'content' => 'Los comedores comunitarios juegan un papel vital en el alivio del hambre. Aquí analizamos cómo funcionan y su impacto en las comunidades más vulnerables.',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '10 recetas saludables con alimentos rescatados',
                'content' => 'Te mostramos 10 recetas saludables y deliciosas que puedes preparar usando alimentos que de otro modo habrían sido desechados. ¡Súmate al rescate alimentario!',
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cómo colaborar con Refood',
                'content' => 'Si te interesa ser parte del cambio, aquí te explicamos las distintas formas en las que puedes colaborar con Refood, ya sea donando alimentos, tiempo o recursos.',
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Impacto ambiental del desperdicio alimentario',
                'content' => 'El desperdicio de alimentos tiene un impacto significativo en el medio ambiente. Aprende cómo afecta al cambio climático y qué podemos hacer al respecto.',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
