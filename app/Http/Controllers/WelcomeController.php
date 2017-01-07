<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class WelcomeController extends Controller
{
    public function index(){
        // get all the nerds
        $items = Item::where('active', '=', '1')->orderBy('created_at', 'desc')->paginate(4);

        // load the view and pass the nerds
        return view('welcome')->with('items', $items);
    }
}
