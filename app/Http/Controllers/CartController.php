<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        return view('cart', compact('carts', 'totalAmount'));
    }
    public function addToCart(Request $request, Product $product)
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

    public function checkout(Request $request)
    {
        // Ambil semua item keranjang untuk pengguna saat ini
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        // Validasi ketersediaan stok produk sebelum melakukan checkout
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return redirect()->route('cart.index')->with('error', 'Stok produk ' . $cart->product->name . ' tidak mencukupi.');
            }
        }

        // Mulai transaksi database
        try {
            \DB::beginTransaction();

            // Buat entri order dalam tabel orders
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => 0, // Nilai awal, akan diupdate nanti
                'status' => 'pending', // Atur status pesanan sesuai kebutuhan
            ]);

            $totalAmount = 0; // Total jumlah pembayaran

            // Buat entri order detail dalam tabel order_details
            foreach ($carts as $cart) {
                $product = $cart->product;
                $quantity = $cart->quantity;
                $price = $product->price;

                // Kurangi stok produk sesuai kuantitas yang dipesan
                $product->stock -= $quantity;
                $product->save();

                // Buat entri order detail
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                // Hitung total pembayaran
                $totalAmount += $quantity * $price;
            }

            // Update total pembayaran pada entri order
            $order->total_amount = $totalAmount;
            $order->save();

            // Hapus semua item dari keranjang
            $carts->each->delete();

            \DB::commit();

            return redirect('/cart')->with('success', 'Checkout berhasil dilakukan. Terima kasih atas pesanan Anda!');
        } catch (\Exception $e) {
            \DB::rollback();

            return redirect('/cart')->with('error', 'Terjadi kesalahan saat melakukan proses checkout. Silakan coba lagi nanti.');
        }
    }

}
