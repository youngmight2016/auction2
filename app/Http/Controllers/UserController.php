<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller{

  	public function show(Request $request){

        if ($request->user()){
            $user_id = $request->user()->id;

            return view('/home')->with('user_id', $user_id);   
        }
    }
}
