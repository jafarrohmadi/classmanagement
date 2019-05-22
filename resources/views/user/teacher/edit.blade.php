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
    <div class="panel-heading panel-heading-divider">Edit Teacher Nip : {{ $teacher->teacher_nip }}.</div>
    <div class="panel-body">

        {!! Form::model($teacher, [
            'method' => 'PATCH',
            'url' => ['/user/teacher', $teacher->id],
            'class' => 'form-vertical',
            'files' => true
        ]) !!}

        @include ('user.teacher.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}

    </div>
</div>
            
@endsection