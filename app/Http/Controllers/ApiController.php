<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Search;
use App\Models\Substance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller{
    public function login(Request $request){
        try {
            $validated = Validator::make($request->all(), [
                "email" => "required",
                "password" => "required",
            ]);
    
            if ($validated->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Login yoki parol kiritilmadi",
                    "error" => $validated->errors(),
                ], 401);
            }
    
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    "status" => false,
                    "message" => "Login yoki parol noto'g'ri.",
                ], 401);
            }
    
            $user = Auth::user();
            $token = $user->createToken("API TOKEN")->plainTextToken;
    
            return response()->json([
                "status" => true,
                "token" => $token,
                'user' => $user,
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 402);
        }
    }

    public function logout(){
        if (auth()->check()) {
            auth()->user()->tokens()->delete();
            return response()->json([
                "status" => true,
                'data' => [],
                "message" => "User Log Out",
            ], 200);
        } else {
            return response()->json([
                "status" => false,
                "message" => "User not authenticated",
            ], 401);
        }
    }
}
