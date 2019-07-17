@extends('layouts.admin')

@section('content')



    <h3>Create Posts</h3>


    {{ Form::open(['method' => 'POST', 'action'=>'PostController@store', 'files'=>true]) }}

    <div class="form-group">

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, ['class'=>'form-control']) }}

    </div>


    <div class="form-group">

        {{ Form::label('category_id', 'Category') }}
        {{ Form::select('category_id',[''=>'Choose Category']+ $categories, null , ['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('photo_id', 'Image') }}
        {{ Form::file('photo_id', null, ['class'=>'form-control']) }}

    </div>


    <div class="form-group">

        {{ Form::label('body', 'Description') }}
        {{ Form::textarea('body', null, ['class'=>'form-control']) }}

    </div>


    <div class="form-group">

        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}

    </div>


    {{ Form::close() }}


@include('admin.includes.form-error')

@endsection