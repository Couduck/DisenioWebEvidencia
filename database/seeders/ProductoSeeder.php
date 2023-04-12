<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            'nombreProducto' => 'Producto 1',
            'descripcionProducto' => 'Descripcion',
            'fotoURLProducto' => 'sample.jpg',
            'precioProducto' => '100',
            'stockProducto' => '50'
        ]);

        DB::table('productos')->insert([
            'nombreProducto' => 'Producto 2',
            'descripcionProducto' => 'Descripcion',
            'fotoURLProducto' => 'sample.jpg',
            'precioProducto' => '250',
            'stockProducto' => '75'
        ]);

        DB::table('productos')->insert([
            'nombreProducto' => 'Producto 3',
            'descripcionProducto' => 'Descripcion',
            'fotoURLProducto' => 'sample.jpg',
            'precioProducto' => '5000',
            'stockProducto' => '5'
        ]);
    }
}
