@extends("layouts.layout")

@section('title', 'Prova')

@php
 $id = $test->gradeClass->id;
 $ar = array(
    "f" => "fácil",
    "m" => "médio",
    "d" => "difícil"
);
@endphp
@section('return' ,"/grade_class/$id/tests")

@section('content')
    <div class="text-white">
        <h1>{{$test->nick}}: ID  {{$test->id}}</h1>
    </div>
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="sla"
                                   aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                   aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                   aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="sla">
                                <svg id = "topics-graphic1" width="500" height = "300"></svg>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <svg id = "topics-graphic2" width="500" height = "300"></svg>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <svg  id = "topics-graphic3" width="500" height = "300" onload="getQues({{$test->id}})"></svg>
                            </div>
                        </div>
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
                                            <td>{{$question->topic->name}}</td>
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
