@extends('layouts.app-user')

@section('content')
@if ($errors->any())
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">Change Password</div>
    <div class="panel-body">
        {!! Form::model($user, [
        'url' => route('user.store.password'),
        'class' => 'form-vertical',
         'files' => true
        ]) !!}
        <div class="row">            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                    {!! Form::label('old_password', 'Your old password') !!}
                    {!! Form::password('old_password', ['class' => 'form-control input-sm', 'placeholder' => 'Enter Your old password']) !!}
                    {!! $errors->first('old_password', '<p class="invalid-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                    {!! Form::label('password', 'New password') !!}
                    {!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Enter New password']) !!}
                    {!! $errors->first('password', '<p class="invalid-block">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm New password:</label>    
                    <input id="password-confirm" type="password" class="form-control input-sm" name="password_confirmation" placeholder="Re-enter new password to confirm" required>
                </div>
            </div>
        </div>
        <div class="row xs-pt-15">
            <div class="col-xs-6">
                {!! Form::submit('Update', ['class' => 'btn btn-space btn-primary']) !!}
                {!! Form::reset('Reset', ['class' => 'btn btn-space btn-default']) !!}
            </div>
            <div class="col-xs-6">
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>
    
@endsection