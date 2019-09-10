@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/question/{{$school->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input name="name" value = "{{$question->nick}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input type="number" value="{{$question->test_id}}" required name ="test_id">
                    </label>
                </div>

                <div>
                    <label>
                        <input type = "number" value="{{$question->topic_id}}" required name ="topic_id">
                    </label>
                </div>

                <div>
                    <label>
                        <input type = "number" value="{{$question->number}}" required name ="number">
                    </label>
                </div>

                <div>
                    <label>
                        <input type = "number" value="{{$question->correct_answer}}" required name ="correct_answer">
                    </label>
                </div>

                <div>
                    <label>
                        <input type = "number" value="{{$question->option_quant}}" required name ="option_quant">
                    </label>
                </div>

                <label>
                    <select name="dificult">
                        <option value="f">Facil</option>
                        <option value="m">Medio</option>
                        <option value="d">Dificil</option>
                    </select>
                </label>

                <div>
                    <button type="submit">Salvar dados</button>
                </div>
            </form>
        </div>
        <div>
            <form method="post" action="/belem/site/question/{{$school->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir questão</button>
                </div>
            </form>
        </div>

    </div>
@endsection
