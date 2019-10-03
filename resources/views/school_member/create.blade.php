@section('hidden_content')
    <div class = "card">
        <div class="card-header"><h1>Criar</h1></div>
        <div class="card-body">
        <form class="form-group" method="post" action="/schoolmember">
            {{csrf_field()}}
            <div>
                <input class = "form-control" type = "number" placeholder="Nº de matrícula" required name ="enroll">
            </div>

            <div>
                <input class = "form-control" placeholder="Nome do Aluno" required name ="name">
            </div>

            <div>
                <input class = "form-control" type = "number" placeholder="Idade" required name ="age">
            </div>

            <div>
                <input class = "form-control" type = "number" placeholder="Class ID" required name ="grade_class_id" value="{{$id}}" hidden>
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Aluno</button>
            </div>
        </form>
        </div>
    </div>
@endsection

