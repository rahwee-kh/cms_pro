@extends('layouts.admin')

@section('content')

    @if(Session::has('action'))

        <p class="bg-success">{{session('action')}}</p>

    @endif

    <h1>Edit Users</h1>
    
    <div class="col-sm-3">
        

        <img src="{{$user->photo ? $user->photo->file :'http://placehold.it/400x400'}}" class="img-responsive img-rounded">
            

        
    </div>
    
    <div class="col-sm-9">

    {{ Form::model($user,['method' => 'PATCH', 'action'=>['AdminUserController@update', $user->id], 'files'=>true]) }}

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
        {{ Form::select('is_active', array(1 => 'active', 0 => 'not active'), null ,['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('photo_id', 'Photo') }}
        {{ Form::file('photo_id', null ,['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class'=>'form-control']) }}

    </div>

    <div class="form-group">

        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}

    </div>


    {{ Form::close() }}


    </div>
    
    
    
    @include('admin.includes.form-error')

@endsection