@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$school->logo}}" />--}}
@endsection

@section('content')
    <div>
        <h1>{{$test->nick}}: ID {{$test->id}}</h1>
        <h3>{{$test->subject_id}}</h3>
    </div>

    <div class="navigator-route">

    </div>
    <?php
        $ar = array(
            "f" => "fácil",
            "m" => "médio",
            "d" => "difícil"
        );
    ?>

    <div class="student-acess">
        <div class="card">
            <ul class="list-group">
                @foreach($test->questions as $question)
                    <li class="list-group-item active">
                        {{$question->nick}}
                    </li>
                    <li style="list-style:none">
                        <table class = "table">
                            <tr>
                                <th>ID do topico</th>
                                <th>Número da questão</th>
                                <th>Resposta correta</th>
                                <th>Dificuldade</th>
                            </tr>
                            <tr>
                                <td>{{$question->topic_id}}</td>
                                <td>{{$question->number}}</td>
                                <td>{{chr($question->correct_answer+96)}}</td>
                                <td>{{$ar[$question->dificult]}}</td>
                            </tr>
                        </table>
                    </li>

                @endforeach
            </ul>
        </div>
    </div>
@endsection
