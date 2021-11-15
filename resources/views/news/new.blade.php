@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <br>
                <button class="btn btn-info btn-lg" onclick="window.location='{{url("/index")}}'">На главную</button>
            </div>
            @foreach($news as $new)
                <hr>
                <h1 class="alert-primary">{{$new->summary}}</h1>
                <p>{{$new->full_description}}</p>
            <div class="image">
                @if ($new->imagePath != '')
                    <img src="{{url($new->imagePath)}}" alt="description" height="300px">
                @endif
            </div>
            <br>
                <button class="btn btn-primary btn-lg" onclick="window.location='{{url('index/'.$new->id.'/edit')}}'">Edit</button>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
