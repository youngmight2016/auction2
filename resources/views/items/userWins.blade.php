@extends('layouts.app')

@section('content')

<div class="container">
    @if(!empty($wins))
    <table class="table table-striped table-bordered" style="width: 1200px;">
            <thread>
                <tr align="center">
                    <th>Title</th>
                    <th>Picture</th>
                    <th>Item owner</th>
                    <th>Your Wining bid</th>
                    <th>Owner Bank Account Number</th>
                    <th>Owner Contact Phone Number</th>
                </tr>
            </thread>
            @foreach($wins as $win)
              <tr>
                <td><h3>{{ $win->item->title }}</h3></td>
                <td><img src="/items/{{ $win->item->picture }}" style="width: 100px; height: 100px;" alt="{{ $win->item->title }}"></td>
                <td><h4>{{ $win->item->user->name }}</h4></td>
                <td><p>{{ $win->winner_bid }}</p></td>
                <td><p>{{ $win->item->user->contactinfo->bankAccNumber }}</p></td>
                <td><p>{{ $win->item->user->contactinfo->phone }}</p></td>
            @endforeach      
    </table>
    @endif
</div>

@endsection