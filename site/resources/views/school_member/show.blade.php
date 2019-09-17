@extends("layouts.layout")

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
                        <td>{{$student->grade_class_id}}</td>
                        <td>{{$student->age}}</td>
                        <td>0</td>
                    </tr>
                </table>

            </div>


        </div>
        <div class = "card float-right">
            <a href="/answered_test/create" class = "btn btn-teal">Adicionar</a>
            <h1 class = " list-group-item active text-center">Testes respondidos</h1>
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
                            <td ><a href="/answered_test/{{$answeredTest->id}}" class="btn btn-primary btn-sm fas fa-eye"></a></td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>

@endsection
