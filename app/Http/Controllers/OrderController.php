<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function orderHistory()
    {
        $orders = Order::with('products')->where('user_id', auth()->id())->get();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function order() {
            
    }
}
