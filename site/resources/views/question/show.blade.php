@extends("layouts.layout")

@section('title', 'questions')

@section('logo')
    {{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('content')

    <div class="class-acess">
        <ul class="list-group">
            @foreach($questions as $question)
                <div>
                    {{--                        <img class="school-image" src="{{$school->image}}">--}}
                    <li class="list-group-item active">{{$question->nick}}</li>
                    <li class="list-group-item">Numero da questao: {{$question->number}}</li>
                    <li class="list-group-item">ID do teste: {{$question->test_id}}</li>
                    <li class="list-group-item">ID do topico{{$question->topic_id}}</li>
                    <li class="list-group-item">Quant. de opcoes: {{$question->option_quant}}</li>
                    <li class="list-group-item">Resposta correta: {{$question->correct_answer}}</li>
                    <li class="list-group-item">Dificuldade: {{$question->dificult}}</li>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
