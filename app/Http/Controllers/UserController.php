<?php
/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 8/3/2019
 * Time: 8:47 PM
 */

namespace App\Http\Controllers;


use App\User;
use Laravel\Lumen\Http\Request;

class UserController extends Controller
{
        public function  index()
        {
            return response()->json(User::all());
        }

        public function myInfo(Request $request)
        {
           // dd($request);
            return response()->json(User::all());
        }
}