@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/member/{{$school_member->id}}/edit"> //TODO: melhorar essa rota
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <input name="enroll" value="{{$school_member->enroll}}">
                    <input name="name" value="{{$school_member->name}}">
                    <input name="age" value="{{$school_member->age}}">

                    <select name="type">
                        <option value="professor">Professor</option>
                        <option value="aluno">Aluno</option>
                    </select>
                </div>

                <div>
                    <button type = "submit">Salvar dados</button>
                </div>
            </form>
        </div>

        <div>
            <form method="post" action="/belem/site/member/{{$school_member->id}}/edit">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir Aluno</button>
                </div>
            </form>
        </div>

    </div>
@endsection
