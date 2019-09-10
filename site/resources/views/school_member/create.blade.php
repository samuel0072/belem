@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/school_member">
            {{csrf_field()}}
            <div>
                <input type = "number" placeholder="Nº de matrícula" required name ="enroll">
            </div>

            <div>
                <input type = "text" placeholder="Nome do Aluno" required name ="name">
            </div>

            <div>
                <input type = "number" placeholder="Idade" required name ="age">
            </div>

            <select name="type">
                <option value="Select" disabled>Select</option>
                <option value="professor">Professor</option>
                <option value="aluno">Aluno</option>
            </select>

            <div>
                <button type = "submit">Criar Aluno</button>
            </div>
        </form>
    </div>
@endsection
