@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/test/{{$id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input class = "form-control" name = "nick" placeholder="{{$test->nick}}" value = "{{$test->nick}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input class = "form-control" type="number" name = "subject_id" placeholder="Subject Id" value = "{{$test->subject_id}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input class = "form-control" type="number" name = "class_id" placeholder="Class Id" value = "{{$test->class_id}}">
                    </label>
                </div>

                <div>
                    <label>
                        <select name = "status">
                            <option value="ready">Ready</option>
                            <option value="inprogress">In Progress</option>
                        </select>
                    </label>
                </div>
                <button type = "submit">Salvar</button>
            </form>
        </div>

        <div>
            <form method="post" action="/belem/site/test/{{$test->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir</button>
                </div>
            </form>
        </div>

    </div>
@endsection
