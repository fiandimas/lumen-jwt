<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller {

    protected function jwt(User $user){
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60,
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function auth(Request $req, User $user){
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->firstOrFail();
        $decryptPassword = Crypt::decrypt($user->password);

        if($decryptPassword == $req->password){
            return response()->json([
                'token' => $this->jwt($user),
            ], 200);
        }else{
            return response()->json([
                'message' => 'Wrong password!'
            ], 400);
        }
    }
}
