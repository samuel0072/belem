@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/class/{{$id}}/tests">
            {{csrf_field()}}
            <div>
                <label>
                    <input placeholder="Nome do tópico" name ="name">
                </label>
                <label>
                    <input placeholder="Descrição" name="description">
                </label>
            </div>
            <div>
                <button type = "submit">Cadastrar tópico</button>
            </div>
        </form>
    </div>
@endsection
