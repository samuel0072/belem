@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/class/{{$id}}/school_member">
            {{csrf_field()}}
            <div>
                <label>
                    <input type = "number" placeholder="Nº de matrícula" required name ="enroll">
                </label>
            </div>

            <div>
                <label>
                    <input placeholder="Nome do Aluno" required name ="name">
                </label>
            </div>

            <div>
                <label>
                    <input type = "number" placeholder="Idade" required name ="age">
                </label>
            </div>

            <label>
                <select name="type">
                    <option value="Select" disabled>Select</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Professor</option>
                </select>
            </label>

            <div>
                <button type = "submit">Criar Aluno</button>
            </div>
        </form>
    </div>
@endsection
