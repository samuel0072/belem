@extends("layouts.create")

@section('add_name', 'Teste Resp.')

<?php
    $id = $student->grade_class->id;
    $studentId = $student->id;
?>

@section('hidden_content')
    @include("ans_test.create", compact('studentId'))
@endsection

@section('return', "/grade_class/$id/students")

@section('title', 'schoolmember')

@section('content')
    <div>
        <div class="card float-left">
            <strong class=" list-group-item active text-center">{{$student->name}}</strong>
            <div class="table-responsive">
                <table class="table">
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
                        <td>{{$student->grade_class->grade_number}}{{$student->grade_class->class_letter}}</td>
                        <td>{{$student->age}}</td>
                        <td>0</td>
                    </tr>
                </table>

            </div>

        </div>
        <div class = "card float-right">
            <h1 class = " list-group-item active text-center" style="margin-top: 0px;">Testes respondidos</h1>
            <div class = "table-responsive">
                <table class="table">
                    <tr>
                        <th>ID da prova</th>
                        <th>Nota</th>
                        <th>Qt de questões</th>
                        <th>Corrigido</th>
                        <th>Ultima Atualização</th>
                        <th>Visualizar</th>
                    </tr>
                    @foreach($student->answeredTests as $answeredTest)
                        <tr>
                            <td><a href="/test/{{$answeredTest->test_id}}">{{$answeredTest->test_id}}</a></td>
                            <td>{{$answeredTest->score}}</td>
                            <td>{{count($answeredTest->questionAnsweredTests)}}</td>
                            <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                            <td>{{$answeredTest->updated_at}}</td>
                            <td >@include("ans_question.create", compact('$answeredTest'))</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>

@endsection
