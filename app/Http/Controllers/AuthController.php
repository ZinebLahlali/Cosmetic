<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'role_id' => 'required|in:2,3',
       ]);

       $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'role_id' => $request->role_id,
       ]);

       
        $token = JWTAuth::fromUser($user);

        return  response()->json([
            'token' => $token,
            'user' => $user,
            'role' => $user->role->name,

        ], 201);
     

    }

   public function login(Request $request)
   {
      $credentials = $request->only('email', 'password');
      
        if(!$token = auth('api')->attempt($credentials)){
            return response()->json([
                'error' => 'Informations invalides'
            ], 401);
        }

        $user = auth('api')->user()->load('role');
     
      return response()->json([
        'token' => $token,
        'user' => $user

      ]);
   }

   
    public function getUsers($id)
    {  $user = auth('api')->user();  
            
        if($user && $user->loadMissing('role')->role?->name === "Admin"){
              
        $userInfo = User::with('role')->find($id);

        if(!$userInfo){
            return response()->json([
                'message' => 'user not found'
            ]);
        }

        return [
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'role' => $userInfo->role->name
        ];
        }
           return response()->json([
                'message' => 'You are not an Admin'
            ], 403);
    
        
       
      
 
       }
   
    }

  

 

