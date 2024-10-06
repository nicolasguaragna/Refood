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
        ]);
    }
}
