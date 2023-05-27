<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            // Handle error when product is not found
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Add the product to the cart session
        $cart = Session::get('cart', []);
        $cart[$productId] = $product;
        Session::put('cart', $cart);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
