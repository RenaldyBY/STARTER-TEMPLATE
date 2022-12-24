<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;  
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)){
            return response()->json([
                'message' => 'Unathorized'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
