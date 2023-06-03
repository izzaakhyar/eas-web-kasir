<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function topupAmount() {
    //     $amounts = array('6000', '12000', '45000', '60000', '90000', '120000', '250000', '400000', '600000');

    //     return view('listProduct', compact('amounts'));
    // }

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
}
