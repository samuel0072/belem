@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/topic/{{$id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input name = "nick" placeholder="{{$topic->nick}}" value = "{{$topic->nick}}">
                    </label>
                </div>

                <div>
                    <label>
                        <input name = "description" placeholder="Description" value = "{{$topic->description}}">
                    </label>
                </div>

                <button type = "submit">Salvar</button>

            </form>
        </div>

        <div>
            <form method="post" action="/belem/site/topic/{{$topic->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir</button>
                </div>
            </form>
        </div>

    </div>
@endsection
