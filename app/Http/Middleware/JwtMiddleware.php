<?php
/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 8/3/2019
 * Time: 8:38 PM
 */

namespace App\Http\Middleware;


use App\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use http\Env\Response;
//use Laravel\Lumen\Routing\Closure;
use Closure;
class JwtMiddleware
{
    public function handle($request,Closure $next,$guard=null)
    {
        $token = explode(" ",$request->header('Authorization'));

        if($token[0]!='Bareer')
        {
            return response()->json(['error','Token prefix is fail!'],401);
        }

        try
        {
            $credantials = JWT::decode($token[1],env('JWT_SECRET'),['HS256']);
        }
        catch (ExpiredException $ex)
        {
            return response()->json([
                'error'=>'Token is expired'
            ],401);
        }
        catch (SignatureInvalidException $e)
        {
            return response()->json([
                'error'=>'Token is invalid'
            ],401);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'error'=>'An error occured'],401);
        }

        $user = User::find($credantials->sub);

        $request->auth = $user;

        return $next($request);
    }
}