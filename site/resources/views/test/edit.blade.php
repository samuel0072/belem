@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 class="h1-responsive">Editar</h1>
        <div>
            <form class="form-group" method="post" action="/test/{{$test->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input class = "form-control" name = "nick" value = "{{$test->nick}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input class = "form-control" type="number" name = "subject_id" value = "{{$test->subject_id}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input class = "form-control" type="number" name = "grade_class_id"  value = "{{$test->grade_class_id}}">
                    </label>
                </div>

                <div>
                    <label>
                        <select class="browser-default custom-select" name = "status">
                            <option value="ready">Ready</option>
                            <option value="inprogress">In Progress</option>
                        </select>
                    </label>
                </div>
                <button class="btn btn-primary" type = "submit">Salvar</button>
            </form>
        </div>

        <div>
            <form class="form-group" method="post" action="test/{{$test->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button class="btn btn-teal" type="submit">Excluir</button>
                </div>
            </form>
        </div>

    </div>
@endsection
