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
    <div class="panel-heading  panel-heading-divider">Create New User </div>
    <div class="panel-body">

        {!! Form::open(['url' => '/user/students', 'class' => 'form-vertical', 'files' => true]) !!}

        @include ('user.students.form')

        {!! Form::close() !!}

    </div>
</div>
@endsection