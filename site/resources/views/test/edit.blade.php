<div class = "card">
    <div class = "card-header">
        <h1 class="h1-responsive">Editar</h1>
    </div>
    <div class = "card-body">
        <div>
            <form class="form-group" method="post" action="/test/{{$test->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>Nome</label>
                    <input class="form-control" name="nick" value="{{$test->nick}}">
                </div>

                <div>
                    <label>Id da disciplina</label>
                    <input class="form-control" type="number" name="subject_id" value="{{$test->subject_id}}">
                </div>

                <div>
                    <label>Id da classe</label>
                    <input class="form-control" type="number" name="grade_class_id" value="{{$test->grade_class_id}}">
                </div>

                <div>
                    <label>Progresso</label>
                    <select class="browser-default custom-select" name="status">
                        <option value="ready">Ready</option>
                        <option value="inprogress">In Progress</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
            <div>
                <form class="form-group" method="post" action="/test/{{$test->id}}">
                    {{csrf_field()}}
                    {{method_field("DELETE")}}
                    <div>
                        <button class="btn btn-teal" type="submit">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
