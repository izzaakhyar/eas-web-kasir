<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });
        $totalProducts = $carts->where('checkout', 0)->count();

        return view('cart', compact('carts', 'totalAmount', 'totalProducts'));
    }

    // addToCart
    public function addTo(Request $request, Product $product)
    {
        // Cek apakah produk sudah ada di keranjang user
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitasnya
            $cart->quantity += 1;
            $cart->save();
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function addToCart(Request $request, $id) {
        $product = Product::where('id', $id)->first();
    $date = Carbon::now();

    $orderCheck = Order::where('user_id', auth()->id())
        ->where('status', 0)
        ->first();

    if (empty($orderCheck)) {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->date = $date;
        $order->status = 0;
        $order->total_price = $product->price * 1;
        $order->save();
    }

    $newCart = Order::where('user_id', Auth::user()->id)
        ->where('status', 0)
        ->first();

    $cart = new Cart;
    $cart->product_id = $product->id;
    $cart->user_id = Auth::user()->id;
    $cart->order_id = $newCart->id;
    $cart->quantity = 1;
    $cart->total = $product->price * 1;
    $cart->checkout = 0;
    $cart->save();

    // Update total_price in orders table
    $totalPrice = Cart::where('user_id', Auth::user()->id)
        ->where('order_id', $newCart->id)
        ->sum('total');

    $newCart->total_price = $totalPrice;
    $newCart->save();

    return redirect('/list');
    }

    public function deleteProduct($productId)
{
    // Cari cart berdasarkan product id
    $cart = Cart::where('product_id', $productId)->first();

    if (!$cart) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan dalam cart.');
    }

    // Hapus cart
    $cart->delete();

    return redirect()->back()->with('success', 'Produk berhasil dihapus dari cart.');
}

public function checkout()
{
    $user = Auth::user();

    // Retrieve the cart items for the current user
    $cartItems = Cart::where('user_id', $user->id)->get();
    $checkoutItems = $cartItems->where('checkout', 0);

    // Calculate the total amount from the cart items
    $totalAmount = 0;
    foreach ($checkoutItems as $item) {
        $totalAmount += $item->total;
    }

    // Check if the user has enough balance
    if ($totalAmount > $user->balance) {
        return redirect()->back()->with('error', 'Insufficient balance. Please top up your balance.');
    }

    // Update the user's balance
    $user->balance -= $totalAmount;
    $user->save();

    // Update the checkout flag in the cart items
    $cartItems->each(function ($item) {
        $item->checkout = 1; // Set checkout flag to 1 indicating the item has been checked out
        $item->save();
    });

    // Update the status of the order to 1
    $order = Order::where('user_id', $user->id)->where('status', 0)->first();
    if ($order) {
        $order->status = 1; // Set the status to 1 indicating the order has been checked out
        $order->save();
    }

    return redirect()->back()->with('success', 'Checkout successful!');
}

    public function history() {
        $user = Auth::user();

    // Retrieve the order history for the current user
    $orderHistory = Cart::with(['product', 'order.user'])
        ->where('user_id', $user->id)
        ->where('checkout', 1)
        ->orderBy('user_id')
        ->orderBy('order_id')
        ->get()
        ->groupBy('order_id');

    return view('history', compact('orderHistory'));
    }
}
