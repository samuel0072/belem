@php
    use App\Http\Controllers\AnsweredTestController;
@endphp

<div class="w3-container">
    <div>
        <button onclick="document.getElementById('id{{$test->id}}').style.display='block'" class="btn btn-mdb-color ">Notas</button>
        <button onclick="corrigir({{$test->id}},  '{{csrf_token()}}')" type="button" class="btn btn-warning" >Corrigir provas</button>
        <form class="form-group" method="post" action="/test/{{$test->id}}">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <div>
                <button class="btn btn-danger float-top" type="submit">Excluir</button>
            </div>
        </form>
    </div>

    <div id="id{{$test->id}}" class="w3-modal w3-animate-opacity" style="z-index: 2;">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id{{$test->id}}').style.display='none'"
                      class="w3-button w3-display-topright">&times;</span>

                <div class='card'>
                    <div class="card-header">
                        <h1>Notas</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <th>Matricula do aluno</th>
                                    <th>Titulo da prova</th>
                                    <th>Nota</th>
                                    <th>Corrigido</th>
                                    <th>Ultima Atualização</th>
                                </tr>
                                @foreach($answeredTests as $answeredTest)
                                    <tr>
                                        @php

                                            $controller = new AnsweredTestController();
                                            $student = $controller->getStudent($answeredTest->id);
                                            $test = $controller->getTest($answeredTest->id);
                                        @endphp
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->enroll}}</td>
                                        <td><a href="/test/{{$answeredTest->test_id}}">{{$test->nick}}</a>
                                        </td>
                                        <td>{{$answeredTest->score}}</td>
                                        <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                                        <td>{{$answeredTest->updated_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
