<?php

namespace App\Http\Controllers;

use App\Models\game;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\display;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller

{
   public function index()
      {
         $game = Game::where('status','publish')->get();
         $displays = display::selectRaw('display.*,game.nama_game,game.harga')
         ->join('game', 'game.id_game', 'display.id_game')
         ->get();
         return view('game-store.store', compact('game','displays'));
      }
   
   
}