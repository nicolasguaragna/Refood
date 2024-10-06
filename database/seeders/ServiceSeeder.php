<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'Rescate S',
                'description' => 'Rescate auto-gestionado',
                'type' => 'S',
                'price' => 20000, // Precio para Rescate S
                'minimum_kg' => 10,
                'logistics_required' => 'No',
                'more_info' => 'Llamados también rescates auto-gestionados. 
                En los casos en que la persona cuente con menos de 20 kgs de alimentos en perfecto estado 
                -en donde nadie de su círculo cercano pueda aprovecharlo-. Refood cuenta con un decálogo para rescates autogestionados. 
                Enviando un email a logistica@refood.com.ar, indicaremos dónde se puede llevar, según la zona. En caso urgente comunicarse con Nicolas al +54 9 11 1111-2222.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate B',
                'description' => 'Rescate con más de 20kg',
                'type' => 'B',
                'price' => 35000, // Precio para Rescate B
                'minimum_kg' => 20,
                'logistics_required' => 'Sí',
                'more_info' => 'Son aquellos en los que se cuenta con más de 20 kilos de alimento excedente. Se comunican con Refood por cualquiera de nuestras vías de comunicación: 
                Web (contacto - solicitar rescate) ó mediante whatsapp o llamado telefónico al 11 1111-2222 (Nicolás). 
                Se coordina con nuestros voluntarios rescatistas expertos que asisten al rescate, y en caso que sea requerido llevan el kit de rescate (bandejas plásticas, film, cofias, barbijos, guantes y delantales) 
                para la correcta manipulación de los alimentos. Inmediatamente es entregado en la institución (comedor, merendero, hogar, etc) más cercana. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate C',
                'description' => 'Rescate de empresas con calendario fijo',
                'type' => 'C',
                'price' => 50000, // Precio para Rescate C
                'minimum_kg' => 50,
                'logistics_required' => 'Sí',
                'more_info' => 'Los Rescates C son aquellos solicitados por fábricas, comedores de empresas comercializadoras que tienen excedentes regulares. 
                Se planifican con Calendario mensual, rescatistas fijos y lugar fijo de entrega. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rescate D',
                'description' => 'Rescate mayor a 1000kg',
                'type' => 'D',
                'price' => 60000, // Precio para Rescate D
                'minimum_kg' => 1000,
                'logistics_required' => 'Sí',
                'more_info' => 'Los rescates D son aquellas solicitudes de empresas, supermercados y productores agropecuarios que cuentan con excedente no comercializable apto para el consumo, 
                mayor a 1.000 kilos. Se coordina la recepción, asignación y distribución. Se reciben en el depósito de Refood, y rápidamente se realiza la entrega (máximo 48 hs) a Instituciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Receptores',
                'description' => 'Programa de apoyo a receptores',
                'type' => 'Receptores',
                'price' => 30000, // Precio para Receptores
                'minimum_kg' => null,
                'logistics_required' => 'No',
                'more_info' => 'Los receptores son una parte esencial de nuestra cadena para aprovechar mejor los alimentos. 
                Este programa se dedica a brindar mejoramiento a la infraestructura de comedores, merenderos y hogares. 
                También se brindan talleres y cursos gratuitos para que tengan más herramientas y aprendan nuevas formas de aprovechar los alimentos.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
