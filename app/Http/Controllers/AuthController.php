<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $credentials = Validator::make($request->all(),[
            'pseudo' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
        ]);

        if($credentials->fails()){
            return response()->json(['error'=> $credentials->errors()], 401);
        }

        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'pseudo' => $request['pseudo'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if($user){
            $user->assignRole('user');
            $token = $user->createToken('access_token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }
    }

    public function login(Request $request){

        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if($credentials->fails()){
            return response()->json(['error' => $credentials->errors()], 401);
        }

        if(!Auth::attempt(['email' => $request['email'], 'password' => $request['password']], true)){
            return response()->json(['error' => $credentials->errors()], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    // il faudra tester que ca fonctionne
    public function logout(){
        if(Auth::user()->currentAccessToken()->delete()){
            return response()->json(['success', 'Déconnexion réussi'], 200);
        }
        return response()->json(['error' => 'Internal serveur error'],500);
    }
}
