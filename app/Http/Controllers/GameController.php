<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Cart;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {
        $games = Game::simplePaginate(8);
        $gameCount = Game::where('user_id', auth()->id())->count();
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();
        return view('library', compact('games', 'gameCount', 'totalProducts'));
    }
}
