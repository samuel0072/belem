@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/answered_test/{{$id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <input type="number" name = "subject_id" required value = "{{$answeredTest->test_id}}" hidden>
                </div>

                <div>
                    <input type="number" value="{{$answeredTest->schoolmember_id}}" required name="schoolmember_id" hidden>
                </div>

                <div>
                    <input name = "score" type="number" placeholder="score">
                </div>

                <div>
                    <input name = "done" type="number" placeholder="done" >
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
