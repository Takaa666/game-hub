<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
      }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required'
            
        ]);
        
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'user';
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request -> session() ->flash('success','Registration Successfull! please login ')
         
        return redirect('/')->with('success','Registration Successfull! please login ');
        
    }
}
