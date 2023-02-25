<?php

namespace App\Http\Controllers;

use App\Models\diskon;
use Illuminate\Http\Request;
use App\Models\game;
use App\Models\transaksi;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index() {
        return view('transaksi.transaksi');
    }

    public function get() {
        $model = transaksi::selectRaw('transaksi.*,users.email,game.nama_game')
            ->join('users', 'users.id' , 'transaksi.id_user')
            ->join('game', 'game.id_game' , 'transaksi.id_game')
            ->get();
            return DataTables::of($model)->make(true);
     }


    public function create($id_game) {
        $id = auth()->user()->id;
        $model = game::findOrFail($id_game);
        $model->diskon = diskon::find(auth()->user()->lastspin)->jumlah_diskon ?? 0;
        $model->total = $model->harga-($model->harga * $model->diskon/100) ;
        $status = ['not_approved'=>'Belum di Approve','approve'=>'Approved'];
        return view('transaksi.create', compact(['id' , 'model','status']));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all() , [
            'id_game' => 'required',
            'bukti_transfer' => 'required|image',
            'harga' => 'required',
            'total' => 'required',
        ],[
            'id_game' => 'Game Harus Diisi',
            'bukti_transfer' => 'Bukti Transfer Harus Berupa Gambar',
            'harga' => 'Harga Harus Diisi',
            'total' => 'Total Harus Dimasukkan',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation',
            ], 400);
        }
    
        try {
            $buktiTransfer = $request->file('bukti_transfer');
            $buktiTransferName = time().'1'.'.'.$buktiTransfer->extension();
        
            $buktiTransfer->move(public_path('assets/images'), $buktiTransferName);

            $data = [
                'id_user' => Auth::user()->id,
                'id_game' => $request->id_game,
                'bukti_transfer' => $buktiTransferName,
                'harga' => $request->harga,
                'total' => $request->total,
                'diskon' => $request->diskon ?? 0,
                'status' => 'not_approved',
            ];
            transaksi::create($data);
            DB::table('users')->where('id', '=',auth()->user()->id)->update(['lastspin' => null]);
            return redirect()->route('detail-game')->with('messages','Pembayaran Berhasil');
        }catch (Exception $e){
            return redirect()->back()->with('messages' , 'Pembayaran Tidak Berhasil');
        }
    }

    public function edit($id_transaksi){
        $model = transaksi::findOrFail($id_transaksi);
        $status = ['not_approved'=>'Belum di Approve','approve'=>'Approved'];
        return view('transaksi.edit', compact(['model' , 'status']));
    }

    public function update(Request $request, $id_transaksi) {
        $validator = Validator::make($request->all() , [
            'status' => 'required',
        ],[
            'status.required' => 'Status Belum Diubah'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'status' => $request->status,
        ];
        $model = transaksi::findOrFail($id_transaksi);
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

    public function view($id_transaksi) {
        $model = transaksi::selectRaw('transaksi.*,users.email,game.nama_game')
            ->join('users', 'users.id' , 'transaksi.id_user')
            ->join('game', 'game.id_game' , 'transaksi.id_game')
            ->findOrFail($id_transaksi);
        return view('transaksi.view', ['model' => $model]);
    }

    public function delete($id_transaksi) {
        $model = transaksi::findOrFail($id_transaksi);
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
