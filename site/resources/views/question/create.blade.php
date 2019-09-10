@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/question">
            {{csrf_field()}}
            <div>
                <label>
                    <input placeholder="Titulo da questao" name ="name">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Id do teste" required name ="test_id">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Id do topico" required name ="topic_id">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Numero da questao" required name ="number">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Opcao correta" required name ="correct_answer">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Id do teste" required name ="test_id">
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
                <button type = "submit">Cadastrar questao</button>
            </div>
        </form>
    </div>
@endsection
