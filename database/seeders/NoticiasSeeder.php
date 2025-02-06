<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Noticia;
use Illuminate\Support\Facades\DB;

class NoticiasSeeder extends Seeder
{
    public function run()
    {
        DB::table('noticias')->insert([
            [
                'titulo' => 'Refood alcanza 100,000 platos donados',
                'contenido' => 'Gracias a la comunidad, hemos logrado donar más de 100,000 platos a quienes más lo necesitan.',
                'imagen' => 'noticias/noticia1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Nueva alianza con supermercados locales',
                'contenido' => 'Estamos felices de anunciar nuestra nueva colaboración con supermercados locales para rescatar alimentos.',
                'imagen' => 'noticias/noticia2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Voluntariado: Cómo puedes ayudar',
                'contenido' => 'Si deseas ayudar en Refood, te contamos cómo puedes sumarte como voluntario.',
                'imagen' => 'noticias/noticia3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Refood en los medios',
                'contenido' => 'Nuestro trabajo ha sido destacado en varios medios nacionales por su impacto social.',
                'imagen' => 'noticias/noticia4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
