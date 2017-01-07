@extends('layouts.app')

@section('content')

<div class="container container-with-sidebar-margin-left">
TAVO LAIMETI ITEMAI

    @foreach($wins as $win)
        <h3>{{ $win->item->title }}</h3>
        <img src="/items/{{ $win->item->picture }}" style="width: 100px; height: 100px;" alt="{{ $win->item->title }}">
        <h4>{{ $win->item->user->name }}</h4>
        <p>You owe: {{ $win->winner_bid }}</p>
        <p>Bankinfo: {{ $win->item->user->bankinfo->bankAccNumber }}</p>

    @endforeach
</div>

@endsection