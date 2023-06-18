<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Cart;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {
        $user_id = auth()->id();
        
        $games = Game::join('products', 'games.product_id', '=', 'products.id')
            ->select('games.*')
            ->where('games.user_id', $user_id) // Filter games owned by the logged-in user
            ->orderBy('products.name', 'asc')
            ->simplePaginate(12);
        
        $gameCount = Game::where('user_id', $user_id)->count();
        
        $carts = Cart::with('product')
            ->where('user_id', $user_id)
            ->where('checkout', 0)
            ->get();

        $totalProducts = $carts->where('checkout', 0)->count();
        
        return view('library', compact('games', 'gameCount', 'totalProducts'));
    }
}
