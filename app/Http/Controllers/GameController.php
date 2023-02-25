<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\game;
use App\Models\games;
use App\Models\genre;
use App\Models\platform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
   public function index() {
    $game = game::with(['komentar.users', 'genre', 'platform' ,'Developer'])->get();
    return view('master-game.game', compact('game'));
   }    

    public function create() {
        $developer = Developer::pluck('nama_perusahaan', 'id_developer');
        $platform = platform::pluck('jenis_platform' , 'id_platform');
        $genre = genre::pluck('nama_genre', 'id_genre');
        $status = ['publish' => 'Publish' , 'unpublish' => 'Unpublish' ];
        return view('master-game.create' , compact(['developer' , 'platform' , 'genre' , 'status']));


    }

    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_game' => 'required',
            'id_developer' => 'required',
            'id_genre' => 'required',
            'deskripsi' => 'required',
            'id_platform' => 'required',
            'harga' => 'required',
            'gambar_sampul' => 'required|image',
            'gambar_detail' => 'required|image',
            'status' => 'required',
        ], [
            'nama_game.required' => 'Nama Game Harus Diisi',
            'id_developer.required' => 'Perusahaan Harus Dipilih',
            'id_genre.required' => 'Genre Harus Dipilih',
            'deskripsi.required' => 'Deskripsi Harus Diisi',
            'id_platform.required' => 'Jenis Platform Harus Dipilih',
            'harga.required' => 'Harga Harus Diisi',
            'gambar_sampul.required' => 'Gambar Sampul Harus Dimasukkan',
            'gambar_sampul.image' => 'Gambar Sampul harus berupa gambar',
            'gambar_detail.required' => 'Gambar Detail Harus Dimasukkan',
            'gambar_detail.image' => 'Gambar Detail harus berupa gambar',
            'status.required' => 'Status Harus Diisi',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation',
            ], 400);
        }
    
        try {
            $gambarSampul = $request->file('gambar_sampul');
            $gambarSampulName = time().'1'.'.'.$gambarSampul->extension();
        
            $gambarSampul->move(public_path('assets/images'), $gambarSampulName);
    
            $gambarDetail = $request->file('gambar_detail');
            $gambarDetailName = time().'2'.'.'.$gambarDetail->extension();
        
            $gambarDetail->move(public_path('assets/images'), $gambarDetailName);
    
            $data = [
                'nama_game' => $request->nama_game,
                'id_developer' => $request->id_developer,
                'id_genre' => $request->id_genre,
                'deskripsi' => $request->deskripsi,
                'id_platform' => $request->id_platform,
                'harga' => $request->harga,
                'gambar_sampul' => $gambarSampulName,
                'gambar_detail' => $gambarDetailName,
                'status' => $request->status,
            ];
            
            
            game::create($data);
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

    public function delete($id_game) {
        $model = game::findOrFail($id_game);
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

    public function edit($id_game) {
        $model = game::findOrFail($id_game);
        $developer = Developer::pluck('nama_perusahaan', 'id_developer');
        $platform = platform::pluck('jenis_platform' , 'id_platform');
        $genre = genre::pluck('nama_genre', 'id_genre');
        $status = ['publish' => 'Publish' , 'unpbulish' => 'Unpublish' ];
        return view('master-game.edit', compact(['model','developer','platform','genre','status']));
    }
    
    public function update(Request $request, $id_game) {
        $validator = Validator::make($request->all(), [
            'nama_game' => 'required',
            'id_developer' => 'required',
            'id_genre' => 'required',
            'deskripsi' => 'required',
            'id_platform' => 'required',
            'harga' => 'required',
            'gambar_sampul' => 'image',
            'gambar_detail' => 'image',
            'status' => 'required',
        ], [
            'nama_game.required' => 'Nama Game Harus Diisi',
            'id_developer.required' => 'Perusahaan Harus Dipilih',
            'id_genre.required' => 'Genre Harus Dipilih',
            'deskripsi.required' => 'Deskripsi Harus Diisi',
            'id_platform.required' => 'Jenis Platform Harus Dipilih',
            'harga.required' => 'Harga Harus Diisi',
            'gambar_sampul.image' => 'Gambar Sampul harus berupa gambar',
            'gambar_detail.image' => 'Gambar Detail harus berupa gambar',
            'status.required' => 'Status Harus Diisi',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation',
            ], 400);
        }
    
        try {
            $game = game::findOrFail($id_game);

            if (file_exists(public_path('assets/images/' . $game->gambar_sampul)) && $request->has('gambar_sampul')) {
                unlink(public_path('assets/images/' . $game->gambar_sampul));
            }
            
            if (file_exists(public_path('assets/images/' . $game->gambar_detail)) && $request->has('gambar_detail')) {
                unlink(public_path('assets/images/' . $game->gambar_detail));
            }            
    
            if ($request->hasFile('gambar_sampul')) {
                $gambarSampul = $request->file('gambar_sampul');
                $gambarSampulName = time() . '1' . '.' . $gambarSampul->extension();
                $gambarSampul->move(public_path('assets/images'), $gambarSampulName);
                $data['gambar_sampul'] = $gambarSampulName;
            }
    
            if ($request->hasFile('gambar_detail')) {
                $gambarDetail = $request->file('gambar_detail');
                $gambarDetailName = time() . '2' . '.' . $gambarDetail->extension();
                $gambarDetail->move(public_path('assets/images'), $gambarDetailName);
                $data['gambar_detail'] = $gambarDetailName;
            }

            $data = [
                'nama_game' => $request->nama_game,
                'id_developer' => $request->id_developer,
                'id_genre' => $request->id_genre,
                'deskripsi' => $request->deskripsi,
                'id_platform' => $request->id_platform,
                'harga' => $request->harga,
                'gambar_sampul' => $gambarSampulName ?? $game->gambar_sampul,
                'gambar_detail' => $gambarDetailName ??  $game->gambar_detail,
                'status' => $request->status,
            ];
    
            $game->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Data has been updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Di Update'
            ]);
        }
    }
    

}

