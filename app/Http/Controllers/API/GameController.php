<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Models\game;
use App\Models\games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        if (isset($id_game)) {
            $game = game::findOrFail($id_game);
            return response()->json(['msg' => 'Data retrieved', 'data' => $game], 200);
        } else {
            $game = game::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $game], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {+
       
            $game = game::create($request->all());
    
            return response()->json($game, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, $id_game)
    {
        $game = Game::find($id_game);
        if (!$game) {
            return response()->json(['message' => 'ID game tidak ditemukan'], 404);
        }
        
        // Ubah data game
        $game->nama_game= $request->input('nama_game');
        $game->deskripsi= $request->input('nama_game');
        $game->id_platform = $request->input('id_platform');
        $game->id_genre = $request->input('id_genre');
        $game->harga = $request->input('harga');
        $game->diskon = $request->input('diskon');
        $game->gambar_sampul = $request->input('diskon');
        $game->gambar_detail = $request->input('gambar_detail');

        $game->save();
        
        return response()->json(['message' => 'Data game berhasil diperbarui']);
    }
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_game)
    {
        $game = game::findOrFail($id_game);
        $game->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
