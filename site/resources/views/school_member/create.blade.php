@section('hidden_content')
    <div>
        <h1>Criar</h1>
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
                <input class = "form-control" type = "number" placeholder="Class ID" required name ="grade_class_id">
            </div>

            <select class="browser-default custom-select" name="type">
                <option value="Select" selected disabled>Select</option>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Aluno</button>
            </div>
        </form>
    </div>
@endsection

