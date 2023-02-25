<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index() {
        return view('master-user.user');
    }

    public function get() {
        $model = user::select('users.*');
            return DataTables::of($model)->make(true);
     }

     public function create() {
        $role = ['admin' => 'Admin' , 'developer' => 'Developer' , 'user' => 'User' ];
        return view('master-user.create', compact(['role']));
     }

     public function store(Request $request) {
        $validator = Validator::make($request->all(), [
             'name' => 'required',
             'email' => 'required',
             'password' => 'required',
             'role' => 'required',
        ], [
             'name.required' => 'Username Harus Diisi',
             'email.required' => 'Email Harus Diisi',
             'password.required' => 'Email Harus Diisi',
             'role.required' => 'Role Harus Dipilih',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ];
        if(user::create($data)) {
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

     public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Username Harus Di Isi',
            'email.required' => 'Email Harus Di Isi',
            'password.required' => 'Password Harus Di Isi',
            'role.required' => 'Role Harus Di Pilih',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'name' => $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
            'role' => $request-> role,

        ];
        $model = user::findOrFail($id);
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

     public function edit($id) {
        $role = ['admin' => 'Admin' , 'developer' => 'Developer' , 'user' => 'User' ];
        $model = user::findOrFail($id);
        return view('master-user.edit', compact(['model' , 'role']));
    }

    public function view($id) {
        $model = user::findOrFail($id);
        return view('master-user.view', ['model' => $model]);
    }

    public function delete($id) {
        $model = user::findOrFail($id);
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
