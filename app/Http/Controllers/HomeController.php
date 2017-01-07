<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Home;
use Auth;
use Session;
use Redirect;

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
    public function index(){
        $hometable = new Home;
        $user_id = Auth::user()->id;
        $bankInfo = $hometable->where('user_id', '=', $user_id)->get();
        return view('home')->with('bankInfo', $bankInfo);
    }

    public function enterBankAccNumber(Request $request){
        $hometable = new Home;

        if(Input::get('bankInfo') == NULL){
            Session::flash('message', 'You did not enter anything');
            return Redirect::to('home');
        }

        $user_id = Auth::user()->id;
        $bankRecords = $hometable->where('user_id', '=', $user_id)->first();

        if($bankRecords == NULL){
            //LENTELEJE NERA IRASU SITO USERIO IR REIKIA SUSKURTI NAUJA
            $hometable->user_id = $user_id;
            $hometable->bankAccNumber = Input::get('bankInfo');
            $hometable->save();
            $bankInfo = $hometable->where('user_id', '=', $user_id)->get();
        }else{
            //LENTELEJE YRA IRASAS SITO USERIO, TAI REIKIA PAKEIST
            $bankRecords->bankAccNumber = Input::get('bankInfo');
            $bankRecords->save();
            $bankInfo = $hometable->where('user_id', '=', $user_id)->get();
        }

        Session::flash('message', 'Successfully entered bankInfo!');
        return Redirect::to('home')->with('bankInfo', $bankInfo);      
    }
}
