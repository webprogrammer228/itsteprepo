@extends('welcome')
@section('content')
    {{csrf_field()}}
    <div class="form-group mb-3">
        <table style="width: 100%; border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">Имя пользователя</td>
                <td style="border: 1px solid black;">Почтовый адрес</td>
                <td style="border: 1px solid black;">Статус</td>
                <td style="border: 1px solid black;">Блокировка</td>
            </tr>
            <tr style="border: 1px solid black;">
                @foreach($user as $u)
                    @if ($u->name !== 'admin')
                        <td style="border: 1px solid black;">{{$u->name}}</td>
                        <td style="border: 1px solid black;">{{$u->email}}</td>
                        <td style="border: 1px solid black;">{{$u->status}}</td>
                        <td style="border: 1px solid black;">
                            {!! Form::open(array('route' => array('users.block', $u->id))) !!}
                                <button type="submit" class="{{$u->status == 0 ? 'btn btn-danger' : 'btn btn-success'}}">{{$u->status == 0 ? 'Заблокировать' : 'Разблокировать'}}</button>
                            {!! Form::close() !!}
                        </td>
                    @endif
            </tr>
            @endforeach
        </table>
    </div>
@endsection
