@extends('main')
@section('title', ' | All Categories')
@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>Categories</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th>{{ $category->id }}</th>
                    <td>{{ $category->name }}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- end of .col-md-8 -->

    <div class="col-md-3">
        <div class="well">
        <h2>New Category</h2>
            {!! Form::open(['route' => 'categories.store']) !!}
            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            <p></p>
            {{ Form::submit('Create Category', ['class' =>'btn btn-block btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection