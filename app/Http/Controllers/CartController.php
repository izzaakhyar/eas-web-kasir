<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        // $totalAmount = $carts->sum(function ($cart) {
        //     return $cart->quantity * $cart->product->price;
        // });
        $totalAmount = $this->calculateTotalAmount($carts);

        session(['totalAmount' => $totalAmount]);

        return view('cart', compact('carts', 'totalAmount'));
    }
    public function addToCart(Request $request, Product $product)
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        // $total_Amount = $carts->sum(function ($cart) {
        //     return $cart->quantity * $cart->product->price;
        // });
        $products = Product::where('id', $product->id)->first();
        $date = Carbon::now();

        // $total_Amount = $this->calculateTotalAmount($carts);

        
        

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

        $order_check = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (empty($order_check)) {
            // Simpan ke tabel order
            $orders = new Order;
            $orders->user_id = auth()->id();
            $orders->date = $date;
            $orders->status = 0;
            
            $orders->save();
        }

        // Hitung kembali totalAmount setelah pembaruan keranjang
    $carts = Cart::with('product')->where('user_id', auth()->id())->get();
    $totalAmount = $this->calculateTotalAmount($carts);

    // Perbarui totalAmount pada order terkait
    if ($order_check) {
        $order_check->totalAmount = $totalAmount;
        $order_check->save();
    }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    private function calculateTotalAmount($carts)
{
    return $carts->sum(function ($cart) {
        return $cart->quantity * $cart->product->price;
    });
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

public function checkout(Request $request)
{
    // Pengurangan balance pengguna berdasarkan totalAmount
    $carts = Cart::with('product')->where('user_id', auth()->id())->get();
    $user = Auth::user();
    $totalAmount = $this->calculateTotalAmount($carts);
    $user->balance -= $totalAmount;
    $user->save();

    // Ubah status order menjadi 1
    $order = Order::where('user_id', $user->id)
        ->where('status', 0)
        ->first();
    $order->status = 1;
    $order->save();

    // Hapus produk yang sudah dibeli dari cart
    $cart = Cart::where('user_id', $user->id)
        ->where('checkout', 0)
        ->first();
    $cart->checkout = 1;
    $cart->save();

    // ... lakukan tindakan lanjutan setelah checkout ...

    return redirect()->back()->with('success', 'Checkout berhasil.');
}

}
