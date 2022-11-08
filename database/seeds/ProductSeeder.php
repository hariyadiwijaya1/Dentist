<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'      => 'Pasta Gigi',
            'category'  => 'Obat',
            'photo'     => 'default.jpg',
            'detail'    => 'Merek terkenal',
            'price'     => '20000',
            'stock'     => '10',
        ]);

        Product::create([
            'name'      => 'Masker OneMed',
            'category'  => 'Masker',
            'photo'     => 'default.jpg',
            'detail'    => 'OneMed',
            'price'     => '30000',
            'stock'     => '10',
        ]);

        Product::create([
            'name'      => 'Antimo',
            'category'  => 'Obat',
            'photo'     => 'default.jpg',
            'detail'    => 'antimo',
            'price'     => '5000',
            'stock'     => '10',
        ]);

        Product::create([
            'name'      => 'Paracetamol',
            'category'  => 'Obat',
            'photo'     => 'default.jpg',
            'detail'    => 'paracetamol',
            'price'     => '3000',
            'stock'     => '10',
        ]);
    }
}
