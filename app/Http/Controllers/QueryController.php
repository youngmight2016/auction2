<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Input;

class QueryController extends Controller
{
    public function search(Request $request)
    {
        //$query = Request::input('search');
        $query = Input::get('search');
        $items = new Item();
        $items = Item::where('title', 'LIKE', '%'.$query.'%')->paginate(6);

        return view('items.searchItem')->with('items', $items)->with('query', $query);
    }
}
