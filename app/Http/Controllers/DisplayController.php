<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\display;
use App\Models\game;
use App\Models\genre;
use App\Models\platform;
use Yajra\DataTables\DataTables;

    class DisplayController extends Controller
{
    public function index() {
        $displays = Display::selectRaw('display.*,game.nama_game,game.harga')
            ->join('game', 'game.id_game' , 'display.id_game')
            ->get();
        
        return view('display.display', compact('displays'));
    }

    public function get() {
        $displays = Display::selectRaw('display.*,game.nama_game,game.harga')
        ->join('game', 'game.id_game', 'display.id_game')
        ->get();
    
        return DataTables::of($displays)->make(true);
    }
    
      

    public function create() {
        $game = game::pluck('nama_game', 'id_game');
        return view('display.create' , compact(['game']));


    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_game' => 'required',
            'gambar_display' => 'required|image',
        ], [
            'id_game' => 'Game Harus Diisi',
            'gambar_display.required' => 'Gambar Display Harus Dimasukkan',
            'gambar_display.image' => 'Gambar Display harus berupa gambar',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation',
            ], 400);
        }
    
        try {
            $gambarDisplay = $request->file('gambar_display');
            $gambarDisplayName = time().'1'.'.'.$gambarDisplay->extension();
        
            $gambarDisplay->move(public_path('assets/images'), $gambarDisplayName);
    
    
            $data = [
                'id_game' => $request->id_game,
                'gambar_display' => $gambarDisplayName,
            ];
            
            
            display::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Data has been stored successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ]);
        }
    
    }

    public function delete($id_display) {
        $model = display::findOrFail($id_display);
        if($model) {
            if($model->delete()) {
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Di Hapus'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Data Gagal Di Hapus'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Data Tidak Di Temukan'
            ];
        }
    }


    
    
    
}

