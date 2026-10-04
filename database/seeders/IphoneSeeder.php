<?php

namespace Database\Seeders;

use App\Models\Iphone;
use Illuminate\Database\Seeder;

class IphoneSeeder extends Seeder
{
    /**
     * Carga el catálogo inicial.
     * Los precios y las descripciones son referenciales: cámbialos a tu gusto.
     * Si tienes fotos, guárdalas en public/img/iphones y escribe el nombre del
     * archivo en 'imagen' (ej: 'iphone-18-pro.png'). Si lo dejas en null se dibuja
     * un iPhone con el color indicado en 'color_hex'.
     */
    public function run(): void
    {
        // Evita duplicados si el seeder se ejecuta más de una vez
        Iphone::truncate();

        $catalogo = [
            [
                'modelo'         => 'iPhone Duo',
                'almacenamiento' => '512GB',
                'color'          => 'Plata',
                'color_hex'      => '#cfd0d4',
                'descripcion'    => 'La pantalla más grande en un iPhone. Plegable. Acomodable. Durable.',
                'nuevo'          => true,
                'precio'         => 1999.00,
                'stock'          => 3,
                'imagen'         => 'iphone-duo.jpg',
            ],
            [
                'modelo'         => 'iPhone 18 Pro',
                'almacenamiento' => '256GB',
                'color'          => 'Borgoña',
                'color_hex'      => '#5a1f2b',
                'descripcion'    => 'El iPhone con mejor rendimiento y cámara, y una batería excepcional.',
                'nuevo'          => true,
                'precio'         => 1199.00,
                'stock'          => 8,
                'imagen'         => 'iphone-18-pro.jpg',
            ],
            [
                'modelo'         => 'iPhone Air',
                'almacenamiento' => '256GB',
                'color'          => 'Azul cielo',
                'color_hex'      => '#a9c8e0',
                'descripcion'    => 'Increíblemente delgado y ligero, con un rendimiento pro.',
                'nuevo'          => false,
                'precio'         => 999.00,
                'stock'          => 12,
                'imagen'         => 'iphone-air.jpg',
            ],
            [
                'modelo'         => 'iPhone 17',
                'almacenamiento' => '256GB',
                'color'          => 'Lavanda',
                'color_hex'      => '#b9a6da',
                'descripcion'    => 'Poderoso, resistente y con batería para todo el día.',
                'nuevo'          => false,
                'precio'         => 799.00,
                'stock'          => 10,
                'imagen'         => 'iphone-17.jpg',
            ],
            [
                'modelo'         => 'iPhone 17e',
                'almacenamiento' => '128GB',
                'color'          => 'Rosa',
                'color_hex'      => '#f2c4cf',
                'descripcion'    => 'Lo esencial de un iPhone, a un precio más accesible.',
                'nuevo'          => false,
                'precio'         => 599.00,
                'stock'          => 15,
                'imagen'         => 'iphone-17e.jpg',
            ],
            [
                'modelo'         => 'iPhone 16',
                'almacenamiento' => '128GB',
                'color'          => 'Ultramarino',
                'color_hex'      => '#3d5fd6',
                'descripcion'    => 'Gran rendimiento y una cámara versátil para el día a día.',
                'nuevo'          => false,
                'precio'         => 699.00,
                'stock'          => 6,
                'imagen'         => 'iphone-16.jpg',
            ],
        ];

        foreach ($catalogo as $iphone) {
            Iphone::create($iphone);
        }
    }
}
