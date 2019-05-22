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
    <div class="panel-heading panel-heading-divider">Edit Students Nis : {{ $students->student_nis }}.</div>
    <div class="panel-body">

        {!! Form::model($students, [
            'method' => 'PATCH',
            'url' => ['/user/students', $students->id],
            'class' => 'form-vertical',
            'files' => true
        ]) !!}

        @include ('user.students.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}

    </div>
</div>
            
@endsection