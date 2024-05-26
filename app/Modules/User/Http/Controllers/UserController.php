<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController
{

    public function index()
    {

        $users = User::all();

        return [
            "payload" => $users,
            "status" => "200"
        ];
    }


    // fonction pour verifier si l'utilisateur existe 
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string|unique:users,username",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        
        $user = User::make($request->all());
        // $user->password="Initial123";
        $user->save();


        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                "payload" => "Incorrect username or password !",
                "status" => "401",
            ];
        }
        $token = $user->createToken( $user->username)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return [
            "payload" => $response,
            "status" => "200"
        ];
    }
}
