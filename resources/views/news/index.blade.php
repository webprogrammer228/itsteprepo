@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <br>
                <button class="btn btn-info btn-lg" onclick="window.location='{{url("/addnew")}}'">Add New</button>
            </div>
            @foreach($news as $new)
                <hr>
                <h2 class="alert-primary">{{$new->summary}}</h2>
                <h4>{{$new->short_description}}</h4>
                <hr>
                @endforeach

        </div>
    </div>
@endsection
