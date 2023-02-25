<?php

namespace App\Http\Controllers;

use App\Models\game;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        
        $query = $request->input('query');
       
        if (  $games = game::where('nama_game', 'like', "%{$query}%")->get()) {
            return view('game-store.search-by', ['game' => $games]);
        }
        else {
            
        }
       
    }
}

