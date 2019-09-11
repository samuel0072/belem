@extends("layouts.layout")

@section('title', 'Criar')

@section('content')
    <div>
        <form method="post" action="/grade_class">
            {{csrf_field()}}
            <div>
                <label for="school_id">ID da escola</label>
                    <input class = "form-control" type = "number" placeholder="Nº da Escola" required name ="school_id">
            </div>

            <div>
                <label for="class_letter">Turma</label>
                    <input class = "form-control" placeholder="Class Letter" required name ="class_letter">

            </div>

            <div>
                <label for="grade_number">Numero da classe</label>
                    <input class = "form-control" type = "number" placeholder="Ano da classe" required name ="grade_number">
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Classe</button>
            </div>
        </form>
    </div>
@endsection
