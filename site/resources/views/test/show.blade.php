@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$school->logo}}" />--}}
@endsection

<?php
 $id = $test->gradeClass->id;
?>
@section('return' ,"/grade_class/$id/tests")

@section('content')
    <div>
        <h1>{{$test->nick}}: {{$test->id}}</h1>
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
        <section id = "left" class="float-left">
                <p>Nenhum gráfico disponivel por enquanto</p>
        </section>
        <section id = "right" class="float-right">
            <div class="card">
                <div class="card-header">
                    <h1>Questoes</h1>
                    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button">Adicionar</button>
                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content">
                            <div class="w3-container"> <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                @include("question.create")
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "card-body">
                    <ul class="list-group">
                        @foreach($test->questions as $question)
                            <a href="/question/{{$question->id}}"  class="list-group-item active text-white">
                                {{$question->nick}}
                            </a>
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
        </section>

    </div>
@endsection
