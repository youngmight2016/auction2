@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Editing: {{ $items->title}}</h1>
                </div>

                <div class="panel-body">

                    {!! Form::model($items, ['action' => ['ItemController@update', $items->id], 'method' => 'PUT']) !!}

                        <p>
                        {!! Form::label('Product Title') !!}
                        </p>
                        <p>
                        {!! Form::text('title') !!}
                        </p>


                        <p>
                        {!! Form::label('Product Description') !!}
                        </p>
                        <p>
                        {!! Form::textarea('description', null, ['class' => 'form-control',
                        'placeholder' => 'Please add your item description here']) !!}
                        </p>

                       
                        <p>
                        {!! Form::submit('Edit', array('class' => 'btn btn-primary')) !!}
                        </p>
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection