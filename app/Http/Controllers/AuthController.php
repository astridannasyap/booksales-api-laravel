<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function Register(Request $request)
    {
        // 1.  Set up Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        // 2. Check Validator
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        }

        // 3. Insert data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // 4. Response
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Created Successfully',
                'data' => $user
            ], 201);
        };

        // 5.  Cek gagal
        return response()->json([
            'success' => false,
            'message' => 'User Failed to Create',
        ], 409);
    }


    public function Login(Request $request)
    {
        // 1.  Set up Validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        // 2. Check Validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 3. Get Kredensial dari request
        $credentials = $request->only('email', 'password');
        

        // 4. Cek Failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is Incorrect',
            ], 401);
        }
        

        // 5. Cek berhasil
        return response()->json([
            'success' => true,
            'message' => 'Login Suscessfully',
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);
    }

    public function Logout(Request $request){
    try {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'Logout Successfully',
        ], 200);

    } catch (JWTException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Logout Failed: ' . $e->getMessage(),
        ], 500);
    }
} 
}
