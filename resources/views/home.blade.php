@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div align="center"><h2>
                        This is {{ Auth::user()->name }} homepage! 
                    </h2></div>
                    <div>
                        To get money from your auctioned items, you need to input your bank account number. 
                    </div>
                    <div>For example: LTXXXXXXXXXXXXXXXX</div>

                    {{ Form::open(array('action' => 'HomeController@enterBankAccNumber', 'method' => 'PUT')) }}
                        <p>
                            {!! Form::text('bankInfo') !!}
                        </p>
                        <p>
                            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                        </p>
                    {{ Form::close() }} 

                    <div>
                        <h2>
                            Your current bank Account Number is: 
                            @foreach($bankInfo as $value)
                                {{ $value->bankAccNumber }}
                            @endforeach  
                        </h2>  
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
