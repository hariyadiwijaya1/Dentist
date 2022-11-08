<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return new ApiResource(true, 'Daftar Produk', Product::get());
    }

    public function show(Product $product)
    {
        return new ApiResource(true, 'Details Product', $product);
    }

    public function store(ProductRequest $request)
    {
        $request->validated();

        $product = Product::create([
            'name'      => request('name'),
            'category'  => request('category'),
            'photo'     => request()->file('photo')->store('img/products'),
            'detail'    => request('detail'),
            'price'     => request('price'),
            'stock'     => request('stock'),
        ]);

        return new ApiResource(true, 'Product berhasil ditambahkan', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return new ApiResource(true, 'Product berhasil dihapus');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $request->validated();

        if(request('photo'))
        {
            Storage::delete($product->photo);
            $photo = request()->file('photo')->store('img/products');
        } else {
            $photo = $product->photo;
        }

        $product->update([
            'name'      => request('name'),
            'category'  => request('category'),
            'photo'     => $photo,
            'detail'    => request('detail'),
            'price'     => request('price'),
            'stock'     => request('stock'),
        ]);

        return new ApiResource(true, 'Product berhasil dirubah', $product);
    }
}
