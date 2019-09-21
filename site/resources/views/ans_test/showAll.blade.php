<div class="w3-container">
    <div>
        <button onclick="document.getElementById('id{{$test->id}}').style.display='block'" class="btn btn-mdb-color ">
            Notas
        </button>
        <button onclick="corrigir({{$test->id}})" type="button" class="btn btn-warning" >Corrigir testes</button>
        <form class="form-group" method="post" action="/test/{{$test->id}}">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <div>
                <button class="btn btn-danger float-top" type="submit">Excluir</button>
            </div>
        </form>
    </div>

    <div id="id{{$test->id}}" class="w3-modal w3-animate-opacity">
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
</div>


<script>
    function corrigir(id) {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", '/test/'+id+'/correct', true);
        ajax.onload = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log("tudo okay");
            }
        };
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("_token="+"{{csrf_token()}}");
    }
</script>
