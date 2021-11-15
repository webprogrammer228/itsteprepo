@extends('layouts.master')
@section('content')

    @if(session('errors'))
        <div class="alert alert-danger">
            @foreach(session('errors')->all() as $er)
                {{$er}} <br>
            @endforeach
        </div>
        @endif
    {!! Form::model($news, array('route' => array('index.update', $news->id), 'method' => 'PUT', 'files' =>true )) !!}
    <div class="form-group">
        {!! Form::label('summary', 'Header:') !!}
        {!! Form::text('summary', $news->summary, session('errors') ? array('class' => 'form-control is-invalid')  : array('class' => 'form-control')) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::label('shortDescription', 'Short Text:') !!}
        {!! Form::text('shortDescription', $news->short_description, session('errors') ? array('class' => 'form-control is-invalid')  : array('class' => 'form-control')) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::label('fullDescription', 'Full Text:') !!}
        {!! Form::textarea('fullDescription', $news->full_description, session('errors') ? array('class' => 'form-control is-invalid', 'cols' => '', 'rows' => '')  : array('class' => 'form-control col-md-10', 'cols' => '', 'rows' => '')) !!}
    </div>
    <div class="mb-3">
        {!! Form::label('imagePath', 'Add image:', array('class' => 'form-label')) !!}
        {!! Form::file('imagePath', array('class' => 'form-control')) !!}
    </div>
    <br>
    {!! Form::submit('Save edit block', array('class' => 'btn btn-success btn-lg')) !!}
    {!! Form::close() !!}
    </div>
@endsection
