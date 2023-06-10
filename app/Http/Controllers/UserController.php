<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\Cart;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function topupAmount() {
    //     $amounts = array('6000', '12000', '45000', '60000', '90000', '120000', '250000', '400000', '600000');

    //     return view('listProduct', compact('amounts'));
    // }
    
    public function user() {
        $users = User::all();

        return view('layouts.navbar', compact('users'));
    }

    public function edit($id)
    {
        $users = User::find($id);
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();
        return view('topup', compact('users', 'totalProducts'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $currentBalance = $user->balance;
        $topUpAmount = $request->balance;

        // Melakukan penambahan nilai balance
        $newBalance = $currentBalance + $topUpAmount;

        // Memperbarui nilai balance pada model User
        $user->balance = $newBalance;
        $user->save();

        return redirect('/list');
    }

    public function editProfil($id) {
        $users = User::find($id);
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();
        $gameCount = Game::where('user_id', auth()->id())->count();
        return view('setting', compact('users', 'carts', 'totalProducts', 'gameCount'));
    }

    public function updateProfil(Request $request, $id) {
        $users = User::find($id);

        if ($request->hasFile('avatar')) {
            // $imagePath = $request->file('image_url')->store('storage/products');
            // $image_url = basename($imagePath);
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move('storage/products', $imageName);
            $image_url = basename($imagePath);
        } else {
            $imageName = null; // Atau Anda bisa menetapkan nilai default untuk gambar jika tidak ada yang diunggah
        }

        $users->update($request->all());
        return redirect('/list')->with('sukses','Data berhasil diupdate');
    }
}
