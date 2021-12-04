@extends('welcome')
@section('content')
    @if (Gate::allows('blocked'))
        <p>К сожалению, вы заблокированы. Просмотр контента для вас более недоступен!</p>

    @else
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('message'))
        <div class="alert alert-success">
            <h2>{{session('message')}}</h2>
        </div>
    @endif

    {!! Form::open(['url' => 'download', 'class' => 'form-control', 'enctype' => 'multipart/form-data']) !!}
    {{csrf_field()}}
    <div class="form-group mb-3">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group mb-3">
        {!! Form::label('artist', 'Artist:') !!}
        {!! Form::text('artist', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group mb-3">
        {!! Form::label('category', 'Select category', ['class' => 'form-label']) !!}
        {!! Form::select('category', $categories, '', ['class' => 'form-select']) !!}
    </div>

    <div class="form-group mb-3">
        {!! Form::label('imagePath', 'Cover:', ['class' => 'form-label']) !!}
        {!! Form::file('imagePath', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group mb-3">
            {!! Form::label('soundPath', 'Sound path:', ['class' => 'form-label']) !!}
            {!! Form::file('soundPath', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group mb-3">
        {!! Form::submit('Отправить', ['class' => 'btn btn-success btn-lg']) !!}
    </div>

    {!! Form::close() !!}
    @endif
@endsection
