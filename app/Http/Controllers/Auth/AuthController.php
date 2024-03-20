<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Internal Server Error',
                'errors' => $validator->errors()
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            $errorMessage = $user ? "Password Salah" : "Email tidak terdaftar";

            return response()->json([
                "message" => $errorMessage
            ], 401);
        }
        $user = User::where('email', $request->email)->first();

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            'message' => 'succes',
            'token' => $token
        ]);
    }
    public function logout(Request $request)
    {
        $acces_token = $request->bearerToken();
        $token = PersonalAccessToken::findToken($acces_token);
        $token->delete();

        return response()->json([
            "status" => 'succes',
            "message" => "Logout succes."
        ]);
    }
}
