@extends("layouts.layout")

@section(   'title', 'Atualizar os dados')

@section('content')
    <!-- todo div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/school/{{$school->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <input name = "name" value = "{{$school->name}}">
                </div>
                <div>
                    <button type = "submit">Salvar dados</button>
                </div>
            </form>
        </div>
        <div>
            <form method="post" action="/belem/site/school/{{$school->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir escola</button>
                </div>
            </form>
        </div>

    </div>
@endsection
