@extends('layouts.admin')

@section('content')

    <h1>Create users</h1>

    {!! Form::open(['method'=>'POST', 'action'=> 'AdminUserController@store', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose options'] + $roles, null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', array(1=>'Active', 2=>'Not active'), 2, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('file', 'Title:') !!}
            {!! Form::file('file', null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Create user', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}



    @include('includes.form_error')


@stop
