<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PassportAuthController extends Controller
{
    // Registration
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json(['user' => $user,'message' => 'Successfully register new user'], 200);
    }

    // Login
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($credentials, true)){
            return response()->json(['message' => 'Incorrect Details. Please try again.'], 400);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json(['user' => auth()->user(), 'token'=>$token], 401);
    }

    // Logout
    public function logout(Request $request){
        $user = auth()->user()->token();
        $user->revoke();
        return response()->json(['message' => 'Logged out'], 200);
    }

}
