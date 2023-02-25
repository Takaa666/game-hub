<?php

namespace App\Http\Controllers;

use App\Models\genre;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
        return view('genre.genre');
    }

    public function get() {
        $model = genre::select('genre.*');
            return DataTables::of($model)->make(true);
     }

     public function create() {
        return view('genre.create');
     }

     public function store(Request $request) {
        $validator = Validator::make($request->all(), [
             'nama_genre' => 'required',
        ], [
             'nama_genre.required' => 'genre Harus Diisi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_genre' => $request->nama_genre,
        ];
        if(genre::create($data)) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Tambahkan'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ];
        }
     }

     public function update(Request $request, $id_genre) {
        $validator = Validator::make($request->all(), [
            'nama_genre' => 'required',
        ], [
            'nama_genre.required' => 'nama genre Harus Di Isi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_genre' => $request->nama_genre,
        ];
        $model = genre::findOrFail($id_genre);
        if($model->update($data)) {
           return [
               'success' => true,
               'message' => 'Data Berhasil Di Update'
           ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Gagal Di Update'
            ];
        }
     }

     public function edit($id_genre) {
        $model = genre::findOrFail($id_genre);
        return view('genre.edit', ['model' => $model]);
    }

    public function view($id_genre) {
        $model = genre::findOrFail($id_genre);
        return view('genre.view', ['model' => $model]);
    }

    public function delete($id_genre) {
        $model = genre::findOrFail($id_genre);
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
