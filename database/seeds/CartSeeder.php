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
            'id_transaction' => 1,
            'id_user'        => 2,
            'id_products'    => 1,
            'quantity'       => 2,
            'total_price'    => '40000',
        ]);
        Cart::create([
            'id_transaction' => 1,
            'id_user'       => 2,
            'id_products'   => 2,
            'quantity'      => 2,
            'total_price'   => '60000',
        ]);
        Cart::create([
            'id_transaction' => NULL,
            'id_user'       => 2,
            'id_products'   => 3,
            'quantity'      => 2,
            'total_price'   => '15000',
        ]);
    }
}
