@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/school_member">
            {{csrf_field()}}
            <div>
                <label>
                    <input class = "form-control" type = "number" placeholder="Nº de matrícula" required name ="enroll">
                </label>
            </div>

            <div>
                <label>
                    <input class = "form-control" placeholder="Nome do Aluno" required name ="name">
                </label>
            </div>

            <div>
                <label>
                    <input class = "form-control" type = "number" placeholder="Idade" required name ="age">
                </label>
            </div>

            <div>
                <label>
                    <input class = "form-control" type = "number" placeholder="Class ID" required name ="grade_class_id">
                </label>
            </div>

            <label>
                <select class="browser-default custom-select" name="type">
                    <option value="Select" selected>Select</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Professor</option>
                </select>
            </label>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Aluno</button>
            </div>
        </form>
    </div>
@endsection
