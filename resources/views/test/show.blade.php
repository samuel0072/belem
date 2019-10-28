@extends("layouts.layout")

@section('title', 'school')

<?php
 $id = $test->gradeClass->id;
?>
@section('return' ,"/grade_class/$id/tests")

@section('content')
    <div class="text-white">
        <h1>{{$test->nick}}: ID  {{$test->id}}</h1>
    </div>
    @php
        $ar = array(
            "f" => "fácil",
            "m" => "médio",
            "d" => "difícil"
        );
    @endphp

    <div class="container-fluid">
        <div class="row">
            <section id = "left" class="col-md-7 text-white">
                <div class = "card-header stylish-color">
                    <label>DADOS</label>
                    @include('layouts.import')
                </div>

                <div class = "card-body stylish-color-dark">
                    <div>
                        <span class="label label-info">Acertos(%) X Descritor</span>
                        <svg id = "topics-graphic" width="1000" height = "300" onload="getQues({{$test->id}})"></svg>
                    </div>
                    <div>
                        <span class="label label-info">Quantidade X Pontuação</span>
                        <svg id = "count-graphic" width="1000" height="300" onload="scoreData({{$test->id}})"></svg>
                    </div>


                </div>
            </section>
            <section id = "right" class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h1>Questoes</h1>
                        <button onclick="document.getElementById('id01').style.display='block'" class="w3-button deep-purple darken-4 text-white">Adicionar</button>
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
                                <div class="d-inline-block">
                                    @include('question.show')
                                </div>

                                <li style="list-style:none">
                                    <table class = "table table-responsive">
                                        <tr>
                                            <th>Descritor</th>
                                            <th>Número da questão</th>
                                            <th>Resposta correta</th>
                                            <th>Dificuldade</th>
                                        </tr>
                                        <tr>
                                            <td>{{App\Topic::findOrFail($question->topic_id)->name}}</td>
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
    </div>
@endsection
