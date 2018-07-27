@extends('main')
@section('title', " | Delete Comment?")
@section('content')

<h1>Edit Comments</h1>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Delete This Commet?</h1>
        <p>
            <strong>Name:</strong> {{ $comment->name }}<br>
            <strong>Email:</strong> {{ $comment->email }}<br>
            <strong>Comment:</strong> {{ $comment->comment }}<br>
        </p>

        {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' =>'DELETE']) }}
            {{ Form::submit('YES DELETE THIS COMMENT', ['class' => 'btn btn-block btn-lg btn-danger']) }}
        {{ Form::close() }}
    </div>
</div>

@endsection()