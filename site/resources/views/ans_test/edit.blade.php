@extends("layouts.layout")

@section(   'title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/answered_test/{{$id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input type="number" name = "subject_id" required value = "{{$answeredTest->test_id}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input type="number" value="{{$answeredTest->schoolmember_id}}" required name="schoolmember_id">
                    </label>
                </div>

                <div>
                    <label>
                        <input name = "score" type="number" placeholder="score">
                    </label>
                </div>

                <div>
                    <label>
                        <input name = "done" type="number" placeholder="done" >
                    </label>
                </div>

                <button type = "submit">Salvar</button>
            </form>
        </div>
        <div>
            <form method="post" action="/belem/site/answered_test/{{$answeredTest->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir</button>
                </div>
            </form>
        </div>

    </div>
@endsection
