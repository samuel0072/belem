@extends("layouts.create")

@section('add_name', 'Teste Resp.')

<?php
    $id = $student->grade_class->id;
    $studentId = $student->id;
    $level = 0;
?>

@section('hidden_content')
    @include("ans_test.create", compact(['studentId', 'level']))
@endsection

@section('return', "/grade_class/$id/students")

@section('title', 'schoolmember')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ">
                <strong class=" list-group-item active text-center">{{$student->name}}</strong>
                <div class="table-responsive">
                    <table class="table white">
                        <tr>
                            <th>ID do aluno</th>
                            <th>Nº de matricula</th>
                            <th>Classe</th>
                            <th>Idade</th>
                            <th>Score total</th>
                        </tr>
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->enroll}}</td>
                            <td>{{$student->grade_class->grade_number." "}}{{$student->grade_class->class_letter}}</td>
                            <td>{{$student->age}}</td>
                            <td>0</td>
                        </tr>
                    </table>

                </div>
                <div id="lower-element" class="card">
                    <div class="card-header">
                        <label>GRAFICOS</label>
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class = "card-body">
                        <span class="label label-info">Acertos(%) X Descritor</span>
                        <!--ate 1200px -->
                        @foreach($student->answeredTests as $answeredTest)
                            <svg id = "student-describer-graph{{$answeredTest->id}}" onload="topicData2({{$answeredTest->test_id}}, {{$answeredTest->id}}, {{$student->id}})"  width="500" height = "300" class="d-sm-block">
                            </svg>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class = "col-md-6">
                <h1 class = " list-group-item active text-center" style="margin-top: 0px;">Testes respondidos</h1>
                <div class = "table-responsive">
                    <table class="table white">
                        <tr>
                            <th>Prova</th>
                            <th>Nota</th>
                            <th>Corrigido</th>
                            <th>Ultima Atualização</th>
                            <th>Visualizar</th>
                        </tr>
                        @foreach($student->answeredTests as $answeredTest)
                            <tr>
                                <td><a href="/test/{{$answeredTest->test_id}}">{{App\Test::findOrFail($answeredTest->test_id)->nick}}</a></td>
                                <td>{{$answeredTest->score}}</td>
                                <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                                <td>{{$answeredTest->updated_at}}</td>
                                <td >@include("ans_question.create", compact('answeredTest'))</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div id="topic-critic" class = "danger-color container shadow-sm p-3 bg-white rounded">
                    <div class="row">
                        <h1 class="col-sm">ATENÇÃO</h1>
                    </div>
                    <div>
                        <span id = "most-error" ></span>
                        <span>é o descritor com mais erros pelo aluno</span>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection










































