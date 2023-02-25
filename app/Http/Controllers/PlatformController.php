<?php

namespace App\Http\Controllers;

use App\Models\platform;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PlatformController extends Controller
{
    public function index() {
        return view('platform.platform');
    }

    public function get() {
        $model = platform::select('platform.*');
            return DataTables::of($model)->make(true);
     }

     public function create() {
        return view('platform.create');
     }

     public function store(Request $request) {
        $validator = Validator::make($request->all(), [
             'jenis_platform' => 'required',
        ], [
             'jenis_platform.required' => 'Platform Harus Diisi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'jenis_platform' => $request->jenis_platform,
        ];
        if(platform::create($data)) {
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

     public function update(Request $request, $id_platform) {
        $validator = Validator::make($request->all(), [
            'jenis_platform' => 'required',
        ], [
            'jenis_platform.required' => 'Jenis Platform Harus Di Isi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'jenis_platform' => $request->jenis_platform,
        ];
        $model = platform::findOrFail($id_platform);
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

     public function edit($id_platform) {
        $model = platform::findOrFail($id_platform);
        return view('platform.edit', ['model' => $model]);
    }

    public function view($id_platform) {
        $model = platform::findOrFail($id_platform);
        return view('platform.view', ['model' => $model]);
    }

    public function delete($id_platform) {
        $model = platform::findOrFail($id_platform);
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
