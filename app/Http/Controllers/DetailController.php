<?php

namespace App\Http\Controllers;

use App\Models\game;
use App\Models\komentar;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function detail($id_game) {
    $model = game::with(['komentar.users', 'genre', 'platform' ,'Developer'])->findOrFail($id_game);
    $model->status=transaksi::where([['id_game',$id_game], ['status' , 'approve'], ['id_user',Auth::user()->id]])->first() ?: false; 
    $komentar = $model->komentar;
    return view('game-store.detail', compact( 'model', 'komentar'));
    }

    public function destroy($id_game) {
    $komentar = komentar::findOrFail($id_game);

    // Hanya user yang membuat komentar bisa menghapusnya
    if (auth()->user()->id !== $komentar->id_user) {
        return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk menghapus komentar ini.');
    }

    $komentar->delete();

    return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }

}
