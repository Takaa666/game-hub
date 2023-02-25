<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAdminContorller extends Controller
{
    public function index() {
        return view('register-admin');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required'
            
        ]);
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'developer';
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request -> session() ->flash('success','Registration Successfull! please login ')
         
        return redirect('/')->with('success','Registration Successfull! please login ');
        
    }
}
