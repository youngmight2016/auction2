@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Submit an item!</h1>
                </div>

                <div class="panel-body">
                    {{ Form::open(array('action' => 'ItemController@store', 'files' => true)) }}
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
                        {!! Form::label('Product Category') !!}
                        </p>
                        <p>
                        {!! Form::select('subcategory', array(
                            'Transportation' => array('Cars' => 'Cars', 'Bicycles' => 'Bicycles', 'Parts' => 'Parts'),
                            'Electronics' => array('Computers' => 'Computers', 'Hardware' => 'Hardware', 'Software' => 'Software'),
                            'Entertainment' => array('Books' => 'Books', 'Games' => 'Games', 'Music' => 'Music'),
                            'Clothes' => array('Women' => 'Women', 'Men' => 'Men', 'Accessories' => 'Accessories'),
                            'Household' => array('Furniture' => 'Furniture', 'Tools' => 'Tools', 'Bedding' => 'Bedding'),  
                        )) !!}
                        </p>


                        <p>
                        {!! Form::label('Product Picture') !!}
                        </p>
                        <p>
                        {!! Form::file('picture') !!}
                        </p>

                        <p>
                        {!! Form::label('Auction End Date') !!}
                        </p>
                        <p>
                        {!! Form::date('date', \Carbon\Carbon::now()->format('Y-m-d')) !!}
                        </p>

                        <p>
                        {!! Form::label('Product Bid') !!}
                        </p>
                        <p>
                        {!! Form::number('bid', null, ['step'=>'0.01', 'min'=>'0.01', 'placeholder'=>'0.00']) !!}
                        </p>

                        <p>
                        {!! Form::submit('Submit') !!}
                        </p>
                        
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- if there are creation errors, they will show here -->
<!-- {{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'indexItem', 'files' => true)) }}

    <div class="form-group">
        {!! Form::label('Product Name') !!}
        <p>{!! Form::text('name', null, array('placeholder'=>'Item name')) !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('Product Name') !!}
        <p>{!! Form::textarea('description', null,
        ['class' => 'form-control',
        'placeholder' => 'Please add your item description here']) !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('Category') !!}
        <p>{!! Form::select('category', ['Phones', 'Laptops', 'Books', 'Furniture', 'Clothes', 'Other...']) !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('Product Image') !!}
        <p>{!! Form::file('picture') !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('Starting bid') !!}
        <p>{!! Form::number('bid', null, ['step'=>'any'], array('placeholder'=>'Starting bid')) !!}</p>
    </div>

        
    {{ Form::submit('Create the Item!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }} -->

<!-- <form action="{{ URL::to('createItem') }}" method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title">
    <input type="text" name="description">
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload" name="submit">
    <input type="hidden" value="{{ csrf_token() }}" name="_token">
</form> -->