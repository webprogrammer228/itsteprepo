@extends('layouts.master')
@section('content')
    <br>
    <div class="row">
        <br>
        <button class="btn btn-info btn-lg" onclick="window.location='{{url("/index")}}'">To news</button>

        @if(session('errors'))
        <div class="alert alert-danger">
            @foreach(session('errors')->all() as $er)
                {{$er}} <br>
            @endforeach
        </div>
    @endif
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        {!! Form::model($news, array('action' => 'newController@store', 'files' => true, 'class' => 'form')) !!}
        <div class="form-group">
            {!! Form::label('summary', 'Header:') !!}
            {!! Form::text('summary', '', session('errors') ? array('class' => 'form-control is-invalid')  : array('class' => 'form-control')) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::label('shortDescription', 'Short Text:') !!}
            {!! Form::text('shortDescription', '', session('errors') ? array('class' => 'form-control is-invalid')  : array('class' => 'form-control')) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::label('fullDescription', 'Short Text:') !!}
            {!! Form::textarea('fullDescription', '', session('errors') ? array('class' => 'form-control is-invalid', 'cols' => '', 'rows' => '')  : array('class' => 'form-control col-md-10', 'cols' => '', 'rows' => '')) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('imagePath', 'Add image:', array('class' => 'form-label')) !!}
            {!! Form::file('imagePath', array('class' => 'form-control')) !!}
        </div>
        <br>
        <button class="btn btn-info" type="submit">Add</button>
        {!! Form::close() !!}
    </div>
@endsection


