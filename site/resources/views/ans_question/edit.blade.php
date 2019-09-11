@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/question_ans_test/{{$id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label for="ans_test_id">ID do teste respondido</label>
                    <input type="number" value="{{$ans_question->ans_test_id}}" required name="ans_test_id">

                </div>

                <div>
                    <label for="question_id">ID da questao</label>
                    <input type="number" value="{{$ans_question->question_id}}" required name="question_id">

                </div>

                <div>
                    <label for="option_choosed">Opcao escolhida</label>
                    <input type="number" value="{{$ans_question->option_choosed}}" required name="option_choosed">

                </div>

                <button type = "submit">Salvar</button>
            </form>
        </div>
        <div>
            <form method="post" action="/belem/site/question_ans_test/{{$question_ans_test->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir</button>
                </div>
            </form>
        </div>

    </div>
@endsection
