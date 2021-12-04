@extends('welcome')
@section('content')
    @if (Gate::allows('admin'))
        @foreach($claims as $claim)
            <div class="form-control mb-3">
                <p>Причина жалобы: <b>{{$claim->reason}}</b></p>
                <p>Текст жалобы: <b>{{$claim->claimbody}}</b></p>
                @foreach($sound as $s)
                    @if($s->sound_id == $claim->sound_id)
                        <p>Композиция, на которую была жалоба: <b>{{$s->title}}</b>
                    @endif
                @endforeach
                <div class="form-group mb-3">
                    {!! Form::open(array('route' => array('claims.destroy', $claim->id))) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-lg']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
    @elseif (Gate::allows('blocked'))
        <p>К сожалению, вы заблокированы. Просмотр контента для вас более недоступен!</p>

    @elseif (Gate::allows('addSong'))
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
        {!! Form::open(['url' => 'claims', 'class' => 'form-control', 'enctype' => 'multipart/form-data']) !!}
        {{csrf_field()}}

        <div class="form-group mb-3">
            {!! Form::label('sound', 'Выберите песню', ['class' => 'form-label']) !!}
            {!! Form::select('sound', $sounds, '', ['class' => 'form-select']) !!}
        </div>

        <div class="form-group mb-3">
            {!! Form::label('reason', 'Причина жалобы:') !!}
            {!! Form::text('reason', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group mb-3">
            {!! Form::label('claimbody', 'Текст жалобы:') !!}
            {!! Form::textarea('claimbody', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group mb-3">
            {!! Form::submit('Отправить', ['class' => 'btn btn-success btn-lg']) !!}
        </div>

        {!! Form::close() !!}

    @endif


@endsection
