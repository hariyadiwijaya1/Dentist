<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\TransactionUpdateRequest;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        return new ApiResource(true, 'Transaksi', Transaction::with('carts')->get());
    }

    public function show($id)
    {
        $transaction = Transaction::with('carts')->find($id);

        return new ApiResource(true, 'Details Transaksi', $transaction);
    }

    public function store(TransactionRequest $request)
    {
        $request->validated();

        //get total harga dari tabel cart
        $total = Cart::where('id_user', request('id_user'))->where('id_transaction', NULL)->sum('total_price');
        $carts = Cart::select('id_products', 'quantity')->where('id_user', request('id_user'))->where('id_transaction', NULL)->get();

        foreach($carts as $cart) {
            //get data stokLama
            $stokLama = Product::where('id', $cart->id_products)->first()->stock;

            if($cart->quantity > $stokLama)
            {
                return response()->json(new ApiResource(false,'Terdapat stok kosong pada produk yang anda pilih', null), 401);
            }else{
                $stokBaru = $stokLama - $cart->quantity;

                //update stok produk
                Product::whereId($cart->id_products)->update([
                    'stock' => $stokBaru,
                ]);
            }
        }

        //create data transaksi nya
        $transaction = Transaction::create([
            'id_user'           => request('id_user'),
            'total_price'       => $total,
            'address'           => request('address'),
            'payment_status'    => 'Belum Lunas',
            'delivery_status'   => 'Menunggu Pembayaran',
        ]);

        //update data cart id transaksi
        Cart::where('id_user', request('id_user'))->where('id_transaction', NULL)->update([
            'id_transaction' => $transaction->id,
        ]);

        return new ApiResource(true, 'Transaksi berhasil dibuat', $transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return new ApiResource(true, 'Transaksi berhasil dihapus');
    }

    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $request->validated();

        $transaction->update([
            'payment_status'    =>  request('payment_status'),
            'delivery_status'   =>  request('delivery_status'),
        ]);

        return new ApiResource(true, 'Transaksi berhasil dirubah', $transaction);
    }
}
