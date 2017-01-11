@extends('layouts.app')

@section('content')


<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

<script type="text/javascript">
    function sendInfoToController(itemID){
        $.ajax({
            type: "POST",
            url: '/showItem/' + itemID,
            data:   {
                        "_token": "{{ csrf_token() }}",
                        "itemID": itemID,
                    },
            success: function(){
                console.log('Success! Item has been made inactive');
            }
        });
    }
</script>

<script type="text/javascript">
    function sendWinnerToController(itemID, winnerID, winningBid){
        $.ajax({
            type: "POST",
            url: '/showItem/' + itemID,
            data:   {
                        "_token": "{{ csrf_token() }}",
                        "itemID": itemID,
                        "winnerID": winnerID,
                        "winningBid": winningBid,
                    },
            success: function(){
                console.log('Success! Auction winner was sent to the controller');
            }
        });
    }
</script>

<div id="background" style="border-color: #636B6F; border-style: solid; margin-left: 20%; margin-right: 5%; border-radius: 10px;">
    <div id="right side info" style="float: right; margin-top: 6%; margin-right: 10%;">
        <h2 style="font-size: 50px" align="center">{{ $items->title }}</h2>
        <p align="center">Description: {{ $items->description }}<p>
        <p align="center">Subcategory: {{ $items->subcategory }}</p>
        <p align="center">Category: {{ $items->category}}</p>
        <p align="center">Starting bid: {{ $items->bid }}</p>

        @if (Auth::user())
            {{ Form::open(array('action' => array('ItemController@bidFunction', $items->id), 'method' => 'PUT')) }}
                @if($maxBid == null)
                    <p align="center">
                    {!! Form::number('bid_field', null, ['step'=>'0.01', 'min'=>$items->bid, 'placeholder'=>'0.00']) !!}
                    </p>
                @else
                    <p align="center">
                    {!! Form::number('bid_field', null, ['step'=>'0.01', 'min'=>$maxBid, 'placeholder'=>'0.00']) !!}
                    </p>
                @endif
                @if(Auth::user()->id == $items->user_id)
                    <h2><p align="center">You can't bid on your own item!</p></h2>
                @else
                    <p align="center">
                        {!! Form::submit('Submit', ['id'=>'bid_button', 'class' => 'btn btn-success']) !!}
                    </p>
                @endif
            {{ Form::close() }}
        @else
            <h3 align="center">You have to be logged in to bid</h3>  
        @endif

        @if( $maxBid == 0)
            <h3 align="center">No bids have been made!</h3>
        @else
            <h3 align="center">Current highest bid is {{ $maxBid }} made by: {{ $maxBidInfo->user_name }}</h3>
        @endif

        <div align="center">Total times bid: {{ $timesBid }}</div>   

        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
    </div>   

    <div>
        <img src="/items/{{ $items->picture }}" style="width: 35%; height: auto; max-height: 400px; margin-top: 8%; margin-left: 10%; border-radius: 10px;">    
    </div>

    <div id="clockdiv" style="margin-left: 10%; margin-top: 5%; margin-bottom: 5%;">
        <div>
            <span class="days"></span>
            <div class="smalltext">Days</div>
        </div>
        <div>
            <span class="hours"></span>
            <div class="smalltext">Hours</div>
        </div>
        <div>
            <span class="minutes"></span>
            <div class="smalltext">Minutes</div>
        </div>
        <div>
            <span class="seconds"></span>
            <div class="smalltext">Seconds</div>
        </div>
    </div>

</div>


<script type="text/javascript">

    var end_data = '{{ $items->end_date }}';

    function getTimeRemaining(endtime){
        //KAZKODEL REIKEJO 2 VALANDAS ATIMT(7200000milisekundziu), GAL DEL TIMEZONE
        var t = Date.parse(endtime) - Date.parse(new Date()) - 7200000;
        var seconds = Math.floor( (t/1000) % 60 );
        var minutes = Math.floor( (t/1000/60) % 60 );
        var hours = Math.floor( (t/(1000*60*60)) % 24 );
        var days = Math.floor( t/(1000*60*60*24) );
        return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
        };
    }

    function initializeClock(id, bidbuttonid, endtime){
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock(){
            var t = getTimeRemaining(endtime);

            daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = t.hours;
            minutesSpan.innerHTML = t.minutes;
            secondsSpan.innerHTML = t.seconds;

            if(t.total<=0){
                document.getElementById(id).innerHTML = 'The item is not active anymore!';
                document.getElementById(bidbuttonid).setAttribute("disabled", "disabled");
                //PASKELBIAMAS NUGALETOJAS IR ITEMAS PADAROMAS NEAKTYVUS
                sendInfoToController('{{ $items->id }}');
                sendWinnerToController('{{ $items->id }}', '{{ $maxBidInfo !== null ? $maxBidInfo->user_id : null }}', '{{ $maxBid ?: null }}');
                clearInterval(timeInterval);
            }
        }
        updateClock(); // run function once at first to avoid delay
        var timeinterval = setInterval(updateClock,1000);
    }
    
    initializeClock('clockdiv', 'bid_button', end_data);
</script>


<style type="text/css">
h1{
    color: #396;
    font-weight: 100;
    font-size: 40px;
    margin: 40px 0px 20px;
}

#clockdiv{
    font-family: sans-serif;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 35px;
}

#clockdiv > div{
    padding: 10px;
    border-radius: 3px;
    /*background: #00BF96;*/
    display: inline-block;
}

/*#clockdiv div > span{
    padding: 15px;
    border-radius: 3px;
    background: #00816A;
    display: inline-block;
    width: 80px;
}*/

/*.smalltext{
    padding-top: 5px;
    font-size: 16px;
}*/
</style>
@endsection