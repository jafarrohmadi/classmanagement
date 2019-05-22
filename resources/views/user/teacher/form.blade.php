<div class="row">
    <div class="col-xs-12 col-md-12">
    	<div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
        	<div class="profile_pic col-xs-12 col-md-8"">
          	@if(isset($teacher->picture))
            	<img src="{{ $teacher->imageUrl() }}" alt="..." class="img-circle profile_img" id='preview'>
          	@else
            	<img src="{{ asset('desain/images/user.png')}}" alt="..." class="img-circle profile_img" id='preview'>
          	@endif  
        	</div>
            <div class="col-xs-12 col-md-4">
                <div class="btn btn-primary btn-block btn-file " id='btn-file'>
                    <i class="fa fa-upload"></i> Upload Teacher Picture<input type="file" class="form-control-file" name="picture" id="pictureFile" aria-describedby="fileHelp" onchange="return ValidateFileUpload()">     
                </div>
                <p class="commentupload">*Upload only image file</p>   
            </div>        
            
        </div>
	    <div class="clearfix"></div>
    	<div class="form-group {{ $errors->has('teacher_nip') ? 'has-error' : ''}}">
            {!! Form::label('teacher_nip', 'Student Nis') !!}
            {!! Form::text('teacher_nip', isset($teacher->teacher_nip) ? $teacher->teacher_nip : $nip, ['class' => 'form-control input-sm', 'readonly' => isset($teacher->teacher_nip) ? true : false]) !!}
            {!! $errors->first('teacher_nip', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Name']) !!}
            {!! $errors->first('name', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
            {!! Form::label('gender', 'Gender') !!} </br>
            {!! Form::radio('gender', 'male') !!} Male
 			{!! Form::radio('gender', 'female') !!} Female
            {!! $errors->first('gender', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
            {!! Form::label('dob', 'Date of Birth') !!}
            {!! Form::text('dob', isset($students->dob) ? date('m/d/Y', strtotime($students->dob)) : null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Date of Birth','id' => 'datemax']) !!}
            {!! $errors->first('dob', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Phone Number']) !!}
            {!! $errors->first('phone', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
            {!! Form::label('address', 'Address') !!}
            {!! Form::textarea('address', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Address']) !!}
            {!! $errors->first('address', '<p class="invalid-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has('experience') ? ' has-error' : ''}}">
            {!! Form::label('experience', 'Experience') !!}
            {!! Form::textarea('experience', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Experience']) !!}
            {!! $errors->first('experience', '<p class="invalid-block">:message</p>') !!}
        </div>        
    </div>
</div>


<div class="row xs-pt-15">
    <div class="col-xs-6">
    </div>
    <div class="col-xs-6">
        <p class="text-right">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-space btn-primary']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-space btn-default']) !!}
        </p>
    </div>
</div>