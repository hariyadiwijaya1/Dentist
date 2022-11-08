<?php

use Illuminate\Database\Seeder;
use App\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cart::create([
            'id_user'       => 1,
            'id_products'   => 1,
            'quantity'      => 2,
            'total_price'   => '40000',
        ]);
    }
}
