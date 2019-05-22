@extends('layouts.app-user')
@section('content')

@if ($errors->any())
<ul class="alert alert-danger list-unstyled">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">Edit Profile </div>
    <div class="panel-body">

        {!! Form::model($user, [
            'method' => 'PATCH',
            'url' => ['/user/profile', $user->id],
            'class' => 'form-vertical',
            'files' => true
        ]) !!}
         <div class="row">
		    <div class="col-xs-12 col-md-12">
		    	<div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}} col-xs-12 col-md-12">
		        	<div class="profile_pic col-xs-12 col-md-8">
		          	@if(isset($user->picture))
		            	<img src="{{ $user->imageUrl() }}" alt="..." class="img-circle profile_img" id='preview'>
		          	@else
		            	<img src="{{ asset('desain/images/user.png')}}" alt="..." class="img-circle profile_img" id ='preview'>
		          	@endif  
		        	</div>
		        	<div class=" col-xs-12 col-md-4">
			        	<div class="btn btn-primary btn-block btn-file " id='btn-file'>
			        		<i class="fa fa-upload"></i> Upload Profile Picture<input type="file" class="form-control-file" name="picture" id="pictureFile" aria-describedby="fileHelp" onchange="return ValidateFileUpload()">		
			        	</div>
			        	<p class="commentupload">*Upload only image file</p>   
		        	</div>         
		        </div>
			    <div class="clearfix"></div>
		    	
		        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
		            {!! Form::label('name', 'Name') !!}
		            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Name']) !!}
		            {!! $errors->first('name', '<p class="invalid-block">:message</p>') !!}
		        </div>
		        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
		            {!! Form::label('email', 'Email') !!}
		            {!! Form::email('email', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Email']) !!}
		            {!! $errors->first('email', '<p class="invalid-block">:message</p>') !!}
		        </div>
		        <div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
		            {!! Form::label('dob', 'Date of Birth') !!}
		            {!! Form::text('dob', isset($user->dob) ? date('m/d/Y', strtotime($user->dob)) : null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Date of Birth','id' => 'datemax']) !!}
		            {!! $errors->first('dob', '<p class="invalid-block">:message</p>') !!}
		        </div>
		        <div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
		            {!! Form::label('phone', 'Phone') !!}
		            {!! Form::text('phone', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Phone Number']) !!}
		            {!! $errors->first('phone', '<p class="invalid-block">:message</p>') !!}
		        </div>        
		    </div>
		</div>


		<div class="row xs-pt-15">
		    <div class="col-xs-6">
		    </div>
		    <div class="col-xs-6">
		        <p class="text-right">
		            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-space btn-primary']) !!}
		            {!! Form::reset('Reset', ['class' => 'btn btn-space btn-default']) !!}
		        </p>
		    </div>
		</div>

        {!! Form::close() !!}

    </div>
</div>
            
@endsection
