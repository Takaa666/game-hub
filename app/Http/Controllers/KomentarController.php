<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\komentar;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
    $komentar = new Komentar;
    $komentar->id_user = auth()->user()->id;
    $komentar->id_game = $request->input('id_game');
    $komentar->komentar = $request->input('komentar');
    $komentar->save();

    return back()->with('success', 'Komentar berhasil disimpan.');
    }
}
