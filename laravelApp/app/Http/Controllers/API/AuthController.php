<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\Manager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8'
        ]);
        if($validator->fails())return response()->json($validator->errors());
        $user = Manager::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password)
        ]);
      //   $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(
        ['data' => $user ]);
      }

    public function login(Request $request) {
      //   if (!Auth::attempt($request->only('email', 'password')))  {
      //      return response()->json(['message' => 'Unauthorized'], 401);
      //   }
        $user = Manager::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message' => 'Chào '.$user->name.'! Chúc an lành',
           'access_token' => $token, 'token_type' => 'Bearer',
         ]);
        }
        public function logout()  {
          auth()->user()->tokens()->delete();
          return ['message' => 'Bạn đã thoát ứng dụng và token đã xóa'];
   }
}