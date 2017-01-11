@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1 class="panel-heading">Homepage of {{ Auth::user()->name }}</h1>

                <div class="panel-body">
                    <div>To get money from your auctioned items, you need to input your bank account number and your phone number so the winner can contact you.</div>
                    <div>When bidding, please make notice of the minimum bid incrementals in our "About" page</div>

                    
                    <div style="margin-top: 5%">
                    {{ Form::open(array('action' => 'HomeController@enterBankAccNumber', 'method' => 'PUT')) }}
                        <p>
                            {!! Form::label('Enter your Bank Account Number:') !!} 
                        </p>
                        <p>
                            {!! Form::text('bankAccNumber', null, ['required', 'placeholder' => 'LTXXXXXXXXX']) !!}
                        </p>
                        <p>
                            {!! Form::label('Enter your Contact Phone Number:') !!} 
                        </p>
                        <p>
                            {!! Form::text('phoneNumber', null, ['required', 'placeholder' => '86XXXXXXX']) !!}
                        </p>
                        <p>
                            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                        </p>
                    {{ Form::close() }} 
                    </div>
                   

                    <div>
                        @foreach($contactinfo as $value)
                            <h3>Your bank Account number: {{ $value->bankAccNumber }}</h3>
                            <h3>Your contact phone: {{ $value->phone }}</h3>
                        @endforeach  
                    </div>

                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
