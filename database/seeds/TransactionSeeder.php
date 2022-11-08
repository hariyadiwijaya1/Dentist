<?php

use App\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'id_user'           => 2,
            'total_price'       => 3,
            'address'           => 2,
            'total_price'       => '100000',
            'payment_status'    => 'Belum Lunas',
            'delivery_status'   => 'Menunggu Pembayaran',
        ]);
    }
}
