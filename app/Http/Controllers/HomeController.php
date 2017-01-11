<?php

namespace App\Http\Controllers;

use App\Home;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hometable = new Home();
        $user_id = Auth::user()->id;
        $contactinfo = $hometable->where('user_id', '=', $user_id)->get();

        return view('home')->with('contactinfo', $contactinfo);
    }

    public function enterBankAccNumber(Request $request)
    {
        $hometable = new Home();

        $user_id = Auth::user()->id;
        $bankRecords = $hometable->where('user_id', '=', $user_id)->first();

        if ($bankRecords == null) {
            $hometable->user_id = $user_id;
            $hometable->bankAccNumber = Input::get('bankAccNumber');
            $hometable->phone = Input::get('phoneNumber');
            $hometable->save();
        } else {
            $bankRecords->bankAccNumber = Input::get('bankAccNumber');
            $bankRecords->phone = Input::get('phoneNumber');
            $bankRecords->save();
        }

        Session::flash('message', 'Successfully entered contactinfo!');

        return Redirect::to('home');
    }
}
