<?php
/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 8/3/2019
 * Time: 8:19 PM
 */

namespace App\Http\Controllers;


use App\User;
use Firebase\JWT\JWT;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function jwt(User $user)
    {
        $payload = [
            'iss'=>'lumen-jwt',
            'sub'=>$user->id,
            'iat'=>time(),
            'exp'=>time()+60*60
        ];

        return JWT::encode($payload,env('JWT_SECRET'));
    }

    public function login(Request $request)
    {
        $this->validate($request,['email'=>'required|email','password'=>'required']);

        $user = User::where('email',$request->input('email'))->first();

        if(!$user)
        {
            return response()->json(['error'=>'Email not found']);
        }

        if(Hash::check($request->input('password'),$user->password))
        {
            return [
                'message'=>'Successfully login',
                'token'=>$this->jwt($user)
            ];
        }

        return response()->json([
            'error'=>'Email or password is incorrect'
        ]);
    }
}