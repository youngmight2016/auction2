<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Bid;
use App\Winner;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Redirect;
use Validator;

class ItemController extends Controller
{
    private $rules;
    private $validator;
    protected $previous;


    public function __construct() {
        $this->previous = app(\Illuminate\Routing\UrlGenerator::class)->previous();
    }

    public function index(){
    	// get all the items
        /*$items = Item::where('active', '=', '1')->orderBy('created_at', 'desc')->paginate(8);*/
        $items = Item::orderBy('created_at', 'desc')->paginate(6);

        // load the view and pass the items
        return view('/items/indexItem')->with('items', $items);
    }

    public function create(Request $request){
    	return view('/items/createItem');
    }

    public function store(Request $request){
    	// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'description'      => 'required|description',
            'subcategory' => 'required|select'
        );

        // store
        $items = new Item;

        $items->user_id = Auth::user()->id;
        $items->title = Input::get('title');
        $items->description = Input::get('description');
        $items->subcategory = Input::get('subcategory');

        if(Input::get('subcategory') == 'Cars' || Input::get('subcategory') == 'Bicycles' || Input::get('subcategory') == 'Parts'){
            $items->category = 'Transportation';
        }else if(Input::get('subcategory') == 'Computers' || Input::get('subcategory') == 'Hardware' || Input::get('subcategory') == 'Software'){
            $items->category = 'Electronics';
        }else if(Input::get('subcategory') == 'Books' || Input::get('subcategory') == 'Games' || Input::get('subcategory') == 'Music'){
            $items->category = 'Entertainment';
        }else if(Input::get('subcategory') == 'Women' || Input::get('subcategory') == 'Men' || Input::get('subcategory') == 'Accessories'){
            $items->category = 'Clothes';
        }else{
            $items->category = 'Household';
        }

        $items->bid = Input::get('bid');

        if(Input::hasFile('picture')){
          
            $file = Input::file('picture');
            $file->move('items/', $file->getClientOriginalName());
          
            $items->picture = $file->getClientOriginalName();
        }

        $items->end_date = Input::get('date');
        $items->created_at = Input::get('created_at');
        $items->updated_at = Input::get('updated_at');
        $items->save();

        // redirect
        Session::flash('message', 'Successfully created an item!');
        return Redirect::to('indexItem');
        
    }

    public function show($id){
    	// get the item by id
        $items = Item::find($id);

        $maxBid = Bid::where('item_id', $id)->max('amount');

        $maxBidInfo = Bid::where('amount', $maxBid)->where('item_id', $id)->first();
        
        $timesBid = Bid::where('item_id', $id)->count();

        return view('items/showItem')->with('items', $items)->with('maxBid', $maxBid)->with('timesBid', $timesBid)->with('maxBidInfo', $maxBidInfo);
    }

    public function listUserItems(){

        $user_id = Auth::user()->id;
        $items = Item::whereUserId($user_id)->get();

        return view('items/userItems')->with('items', $items);  
    }

    public function edit($id){
    	// get the item
        $items = Item::find($id);

        // show the edit form and pass the items
        return view('items/editItem')->with('items', $items);
    }

    public function update(Request $request, $id){
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'description'      => 'required|description',
        );
        // store
        $items = Item::find($id);
        $items->title = Input::get('title');
        $items->description = Input::get('description');
        $items->save();

        // redirect
        Session::flash('message', 'Successfully updated item!');
        return Redirect::to('userItems');
    }

    public function destroy(){
    	// delete
        $item_id = Input::get('item_id');
        $item = Item::find($item_id);
        $item->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the item!');
        return Redirect::to('userItems');
    }

    public function itemsByCategory($category){
        $items = new Item;

        if($category == 'Transportation'){
            //randa itemus kuriu subcategory yra: automobiliai, dviraciai, paslaugos
            $items = Item::where('category', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }else if($category == 'Electronics'){
            //randa itemus kuriu subcategory yra: kompiuteriai, priedai, programine iranga
            $items = Item::where('category', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }else if($category == 'Entertainment'){
            //randa itemus kuriu subcategory yra: knygos, turizmas, muzika
            $items = Item::where('category', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }else if($category == 'Clothes'){
            //randa itemus kuriu subcategory yra: moterims, vyrams, papuosalai ir kita
            $items = Item::where('category', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }else if($category == 'Household'){
            //randa itemus kuriu subcategory yra: mobilieji telefonai, radijo ir gps iranga, Dalys ir priedai
            $items = Item::where('category', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }else{
            //randa itemus pagal SUBCATEGORY
            $items = Item::where('subcategory', $category)->get();
            return view('items/itemsByCategory')->with('items', $items);
        }
    }

    public function bidFunction(Request $request, $id){
        $bids = new Bid;


        $this->rules = [
            'bid_field' => 'required|numeric',
        ];

        $this->validator = Validator::make($request->all(), $this->rules);

        if ($this->validator->fails()) {
            return redirect($this->previous)->with(['id' => $id])->withErrors($this->validator)->withInput();
        } 
        //Call to a member function fails() on null  

        $bidsum = $request->get('bid_field');
        //$bidsum = Input::get('bid_field');


        $startingBid = Item::find($id)->bid;
        $maxBid = Bid::where('item_id', $id)->max('amount');

        if($maxBid == NULL){
            //echo "kintamajam priskiriu startingBid";
            $bidValue = $startingBid;
        }else{
            //echo "maxbid yra $maxBid todel kintamajam priskiriu maxbid";
            $bidValue = $maxBid;
        }

        $bidDifference = $bidsum - $bidValue;

        $valueRange = collect([
            ['lowest' => 0.01, 'highest' => 0.99, 'minimumDifference' => 0.05],
            ['lowest' => 1.00, 'highest' => 4.99, 'minimumDifference' => 0.25],
            ['lowest' => 5.00, 'highest' => 24.99, 'minimumDifference' => 0.50],
            ['lowest' => 25.00, 'highest' => 99.99, 'minimumDifference' => 1.00],
            ['lowest' => 100.00, 'highest' => 249.99, 'minimumDifference' => 2.50],
            ['lowest' => 250.00, 'highest' => 999999.00, 'minimumDifference' => 5.00],
        ]);

        $fittingValues = $valueRange->filter(
                                            function ($value) use ($bidValue) { 
                                                return $bidValue >= $value['lowest'] && $bidValue <= $value['highest']; 
                                            }
                                        )->collapse();

        if( $bidDifference < $fittingValues['minimumDifference'] ){
            Session::flash('message', "Can't bid lower $fittingValues[minimumDifference]. Read the 'About' page why");
            /*return redirect($this->previous)->with([‘id’ => $id])->withInput();*/
            return back();
        }else{
            $bids->item_id = $id;
            $bids->user_id = Auth::user()->id;
            $bids->user_name = Auth::user()->name;
            $bids->amount = Input::get('bid_field');
            $bids->save();
            //return redirect($this->previous)->with('message', "Your bid was Successfull!");
            return back()->with('message', "Your bid was Successfull!");
        }
    
    /*
        if($bidValue >= 0.01 && $bidValue <= 0.99){
            if($bidDifference < 0.05){
                Session::flash('message', "Can't bid lower than 0.05. Read the 'About' page why");
                return back();
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();
            }
        }else if($bidValue >= 1.00 && $bidValue <= 4.99){
            if($bidDifference < 0.25){
                Session::flash('message', "Can't bid lower than 0.25. Read the 'About' page why");
                return back();
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();
            }
        }else if($bidValue >= 5.00 && $bidValue <= 24.99){
            if($bidDifference < 0.50){
                Session::flash('message', "Can't bid lower than 0.50. Read the 'About' page why"); 
                return back();
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();
            }
        }else if($bidValue >= 25.00 && $bidValue <= 99.99){
            if($bidDifference < 1.00){
                Session::flash('message', "Can't bid lower than 1.00. Read the 'About' page why");
                return back();
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();                
            }
        }else if($bidValue >= 100.00 && $bidValue <= 249.99){ 
            if($bidDifference < 2.50){
                Session::flash('message', "Can't bid lower than 2.50. Read the 'About' page why");
                return back();
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();
            }
        }else if($bidValue >= 250.00 && $bidValue <=999999){
            if($bidDifference < 5){
                Session::flash('message', "Can't bid lower than 5.00. Read the 'About' page why");
                return back();  
            }else{
                $bids->item_id = $id;
                $bids->user_id = Auth::user()->id;
                $bids->user_name = Auth::user()->name;
                $bids->amount = Input::get('bid_field');
                $bids->save();
                Session::flash('message', "Your bid was Successfull!");
                return back();
            }
        } */          
    }

    public function makeItemInactive($id){
        $item = Item::find($id);
        $item->active = '0';
        $item->save();
    }

    public function showUserWinsPage(){
        return view('items.userWins')->with(['wins' => Winner::where('user_id',Auth::user()->id)->with('item')->get()]);
    }

    public function declareWinner($id){
        $winners = new Winner;

        $winnerID = Input::get('winnerID');
        $winningBid = Input::get('winningBid');

        $previousWinningsCounter = $winners->where('item_id', $id)->where('user_id', $winnerID)->where('winner_bid', $winningBid)->count();

        if($previousWinningsCounter > 0){
            $previousWinnings = $winners->where('item_id', $id)->where('user_id', $winnerID)->where('winner_bid', $winningBid)->first();
            $previousWinnings->item_id = $id;
            $previousWinnings->user_id = $winnerID;
            $previousWinnings->winner_bid = $winningBid;
            $previousWinnings->save();
        }else{
            $winners->item_id = $id;
            $winners->user_id = $winnerID;
            $winners->winner_bid = $winningBid;
            $winners->save();
        }
    }
}
