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
    <div class="panel-heading panel-heading-divider">Edit Class ID : {{ $class->id }}.</div>
    <div class="panel-body">
        {!! Form::model($class, [
            'method' => 'PATCH',
            'url' => ['/user/class', $class->id],
            'class' => 'form-vertical',
            'files' => true
        ]) !!}

        @include ('user.class.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}
    </div>
</div>
            
@endsection