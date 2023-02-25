<?php

namespace App\Http\Controllers;

use App\Models\diskon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuckyWheelController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah pernah melakukan spin sebelumnya
        $users = Auth::user();
        $lastSpin = $users->lastspin;

        if ($lastSpin) {
            $lastVoucher = diskon::find($lastSpin);
            return view('lucky-wheel.result', ['lastVoucher' => $lastVoucher]);
        } else {
            return view('lucky-wheel.spin');
        }
    }

    public function spin(Request $request)
    {
        // Cek apakah user sudah pernah melakukan spin sebelumnya
        $user = Auth::user();
        $lastSpin = $user->lastspin;

        if ($lastSpin) {
            return redirect()->route('lucky-wheel-spin');
        } else {
            // Hitung nilai voucher secara acak
            $vouchers = [
                '5',
                '10',
                '5',
                '15',
                '5',
                '10',
            ];
            $randIndex = array_rand($vouchers);
            $voucherName = $vouchers[$randIndex];

            // Simpan informasi spin ke database
            $voucher = new Diskon;
            $voucher->id_user = $user->id;
            $voucher->jumlah_diskon = $voucherName;
            $voucher->save();

            // Update informasi spin terakhir pada user
            $users = User::findOrFail($user->id);
            $users->lastspin = $voucher->id_diskon;
            $users->lastspin_hours = now();
            $users->save();

            return response()->json([
                'success' => true,
                'message' => 'Data has been updated successfully',
            ]);
        }
    }
}

