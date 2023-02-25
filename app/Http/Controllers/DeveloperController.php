<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeveloperController extends Controller
{
    public function index(){
        return view('developer.developer');
    }

     public function get() {
        $model = Developer::select('developer.*');
            return DataTables::of($model)->make(true);
     }

     public function create() {
        return view('developer.create');
     }

     public function store(Request $request) {
        $validator = Validator::make($request->all(), [
             'nama_perusahaan'     => 'required',
             'website_perusahaan'  => 'required',
             'alamat_perusahaan'   => 'required',
             'no_perusahaan'       => 'required'
        ], [
             'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi',
             'website_perusahaan.required' => 'Field Harus Diisi',
             'alamat_perusahaan.required' => 'Alamat Harus Diisi',
             'no_perusahaan.required' => 'Nomor Harus Diisi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'website_perusahaan' => $request->website_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'no_perusahaan' => $request->no_perusahaan,
        ];
        if(Developer::create($data)) {
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

     public function update(Request $request, $id_developer) {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'website_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'no_perusahaan' => 'required',
        ], [
            'nama_perusahaan.required' => 'Nama Perusahaan Harus Di Isi',
            'website_perusahaan.required' => 'Website Perusahaan Harus Di Isi',
            'alamat_perusahaan.required' => 'Alamat Harus Di Isi',
            'no_perusahaan.required' => 'Nomor Harus Di Isi'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'website_perusahaan' => $request->website_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'no_perusahaan' => $request->no_perusahaan,
        ];
        $model = Developer::findOrFail($id_developer);
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

     public function edit($id_developer) {
        $model = Developer::findOrFail($id_developer);
        return view('developer.edit', ['model' => $model]);
    }

    public function view($id_developer) {
        $model = Developer::findOrFail($id_developer);
        return view('developer.view', ['model' => $model]);
    }

    public function delete($id_developer) {
        $model = Developer::findOrFail($id_developer);
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
