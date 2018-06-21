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
    <div class="panel-heading  panel-heading-divider">Create New Teacher </div>
    <div class="panel-body">

        {!! Form::open(['url' => '/user/teacher', 'class' => 'form-vertical', 'files' => true]) !!}

        @include ('user.teacher.form')

        {!! Form::close() !!}

    </div>
</div>
@endsection