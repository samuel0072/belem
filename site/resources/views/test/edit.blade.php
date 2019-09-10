@extends("layouts.layout")

@section(   'title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/answered_test/{{$answeredTest->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <input name = "test_id" placeholder="test_id" value = "{{$answeredTest->test_id}}">
                </div>
                <div>
                    <input name = "school_member_id" type="numeric" placeholder="school_member_id" value = "{{$answeredTest->school_member_id}}">
                </div>
                <div>
                    <input name = "score" type="numeric" placeholder="score">
                </div>
                <div>
                    <input name = "done" type="numeric" placeholder="done" >
                </div>
                <button type = "submit">Salvar</button>
        </div>
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
