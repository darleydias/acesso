<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        // Valido os campos
        // $fields = $request->validate([
        //     'name'=>'required|string',
        //     'email'=>'required|string|unique:user,email',
        //     'password'=>'required|string|confirmed'
        // ]);

        // Crio usuario
        // 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken($request->nameToken)->plainTextToken;
        $result =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($result,201);
    }
    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email',$fields['email'])->first();

        if(!$user||!Hash::check($fields['password'],$user->password)){
            return response(['message'=>'usuario ou senha inválidos'],401);
        };
        $token = $user->createToken('usuarioLogado')->plainTextToken;
        $result =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($result,201);
    }
}
