<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use App\Models\Game;
use App\Models\Cart;
use Illuminate\Http\Request;

class UserController extends Controller
{
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

        $message = "Top Up sebesar IDR " . number_format($topUpAmount) . " berhasil";
        Alert::success('Success', $message);
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
        $user = User::find($id);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('storage/products'), $imageName);
            $image_url = basename($imagePath);
            $user->avatar = $image_url;
        }

        $user->update($request->except('avatar'));

        $message = "Profil berhasil diupdate";
        Alert::success('Success', $message);
        return redirect('/list')->with('sukses','Data berhasil diupdate');
    }
}
