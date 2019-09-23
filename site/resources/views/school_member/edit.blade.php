<div style="display:inline" class="w3-container">
    @if(auth()->user()->access_level > 0)
    <button onclick="document.getElementById('id{{$student->id}}').style.display='block'"
            class="btn btn-warning ">Editar
    </button>
    @endif
    <a class="btn btn-primary" href="/schoolmember/{{$student->id}}">Exibir Provas</a>
    @if(auth()->user()->access_level > 0)
    <div id="id{{$student->id}}" class="w3-modal">
        <div  class="w3-modal-content">
            <div class="w3-container">
                <a onclick="document.getElementById('id{{$student->id}}').style.display='none'"
                   class="w3-button w3-display-topright">&times;</a>

                <div class="card">
                    <div class="card-header">
                        <h1>Editar</h1>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <form method="post" action="/schoolmember/{{$student->id}}">
                                {{csrf_field()}}
                                {{method_field("PATCH")}}
                                <div>
                                    <label>Nº de matricula</label>
                                    <input type="number" name="enroll" value="{{$student->enroll}}" class="form-control">

                                    <label>Nome</label>
                                    <input class="form-control" name="name" value="{{$student->name}}">

                                    <label>Idade</label>
                                    <input type="number" name="age" value="{{$student->age}}" class="form-control">

                                    <div>
                                        <input name="grade_class_id" value="{{$student->grade_class_id}}" hidden >
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-primary" type="submit" class="form-control">Salvar dados</button>
                                </div>
                            </form>
                        </div>

                        <div class="form-group">
                            <form method="post" action="/schoolmember/{{$student->id}}">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <div>
                                    <button class="btn btn-danger" type="submit">Excluir Aluno</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


