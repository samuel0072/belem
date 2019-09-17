<div class="w3-container">
    <button onclick="document.getElementById('id{{$test->id}}').style.display='block'" class="btn btn-mdb-color ">Notas</button>
    <button onclick="document.getElementById('id{{$test->id}}1').style.display='block'" class="btn btn-warning ">Editar</button>
    <div id="id{{$test->id}}" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id{{$test->id}}').style.display='none'"
                      class="w3-button w3-display-topright">&times;</span>
                <h1>Notas</h1>

                <div class='card'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <th>ID do aluno</th>
                                    <th>ID da prova</th>
                                    <th>Nota</th>
                                    <th>Corrigido</th>
                                    <th>Ultima Atualização</th>
                                </tr>
                                @foreach($answeredTests as $answeredTest)
                                    <tr>
                                        <td>{{App\SchoolMember::findOrFail($answeredTest->school_member_id)->name}}</td>
                                        <td>{{$answeredTest->school_member_id}}</td>
                                        <td><a href="/test/{{$answeredTest->test_id}}">{{$answeredTest->test_id}}</a>
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

    <!-- EDITAR UM TESTE RELACIONADO COM UM ANS_TEST -->
    <div id="id{{$test->id}}1" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id{{$test->id}}1').style.display='none'"
                      class="w3-button w3-display-topright">&times;</span>

                @include('test.edit')
            </div>
        </div>
    </div>



</div>



