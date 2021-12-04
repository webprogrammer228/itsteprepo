@extends('welcome')
@section('content')
    @if (Gate::allows('blocked'))
        <p>К сожалению, вы заблокированы. Просмотр контента для вас более недоступен!</p>

    @else
    {!! Form::open([SoundController::class, 'index']) !!}
    {{csrf_field()}}
    <div class="form-group mb-3">
        {!! Form::label('category', 'Выберите категорию', ['class' => 'form-label']) !!}
        {!! Form::select('category', $categories, '', ['class' => 'form-select category', 'id' => 'categories']) !!}
    </div>

    <div class="form-group mb-3">
        {!! Form::submit('Найти', ['class' => 'btn btn-success btn-lg']) !!}
    </div>

    {!! Form::close() !!}

    <div class="sounds" style="display: flex; justify-content: space-between;">
        @foreach($songs as $s)
            <div class="card mb-3" style="width: 350px; justify-content: space-between">
                <img src="{{asset($s->imagePath)}}" alt="" width="350" height="300">
                <div class="card-body">
                    <p>{{$s->title}}</p>
                    <p>
                        <audio
                            controls
                            src="{{$s->soundPath}}">
                            Your browser does not support the
                            <code>audio</code> element.
                        </audio>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    {{--    <script type="text/javascript">--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('.category').change(function () {--}}
    {{--                if ($(this).val() != '')--}}
    {{--                {--}}
    {{--                    var value = $(this).val();--}}
    {{--                    console.log(value);--}}
    {{--                    $.ajax({--}}
    {{--                        url: "/songs",--}}
    {{--                        method: "GET",--}}
    {{--                        data: { value: value},--}}
    {{--                        success: function (result)--}}
    {{--                        {--}}
    {{--                            console.log(result);--}}
    {{--                        }--}}
    {{--                    })--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
