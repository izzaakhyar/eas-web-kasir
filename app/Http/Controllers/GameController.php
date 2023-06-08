<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {
        $games = Game::all();

        return view('library', compact('games'));
    }
}
