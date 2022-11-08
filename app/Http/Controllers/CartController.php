<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function show(Cart $cart)
    {
        return new ApiResource(true, 'Details Cart', $cart);
    }

    public function store(CartRequest $request)
    {
        $request->validated();

        $dataProduct = Product::where('id', request('id_products'))->first()->price;

        $cart = Cart::create([
            'id_user'      => request('id_user'),
            'id_products'  => request('id_products'),
            'quantity'     => request('quantity'),
            'total_price'    => $dataProduct * request('quantity'),
        ]);

        return new ApiResource(true, 'Cart berhasil dibuat', $cart);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return new ApiResource(true, 'Cart berhasil dihapus');
    }

    public function update(CartUpdateRequest $request, Cart $cart)
    {
        $request->validated();

        $dataProduct = Product::where('id', request('id_products'))->first()->price;

        $cart->update([
            'quantity'     => request('quantity'),
            'total_price'    => $dataProduct * request('quantity'),
        ]);

        return new ApiResource(true, 'Cart berhasil ditambahkan', $cart);
    }
}
