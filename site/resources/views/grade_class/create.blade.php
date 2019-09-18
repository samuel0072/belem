@section('hidden_content')
    <div class = "card">
        <div class="card-header"><h1>Criar</h1></div>
        <div class="card-body">
        <form method="post" action="/grade_class">
            {{csrf_field()}}
            <div>
                <input class = "form-control" type = "number" placeholder="Nº da Escola" required name ="school_id" value="{{$id}}" hidden>
            </div>

            <div>
                <span class="label label-default" for="class_letter">Turma</span>
                <input class = "form-control" placeholder="Class Letter" required name ="class_letter">

            </div>

            <div>
                <span class="label label-default" for="grade_number">Numero da classe</span>
                <input class = "form-control" type = "number" placeholder="Ano da classe" required name ="grade_number">
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Classe</button>
            </div>
        </form>
        </div>
    </div>
@endsection
