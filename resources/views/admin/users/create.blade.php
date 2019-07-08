@extends('layouts.admin')

@section('content')

    <h1>Create Users</h1>

    {{ Form::open(['method' => 'POST', 'action'=>'AdminUserController@store', 'files'=>true]) }}

        <div class="form-group">

            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class'=>'form-control']) }}

        </div>

    <div class="form-group">

        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, ['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('role_id', 'Role') }}
        {{ Form::select('role_id',[''=>'Choose Options'] + $roles, null,['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('is_active', 'Status') }}
        {{ Form::select('is_active', array(1 => 'active', 0 => 'not active'), 0 ,['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('file', 'Photo') }}
        {{ Form::file('file', null ,['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}

    </div>


    {{ Form::close() }}


    @include('admin.includes.form-error')

@endsection