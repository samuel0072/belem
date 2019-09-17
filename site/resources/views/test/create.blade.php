@section('hidden_content')
    <h1>Criar Teste</h1>
    <div>
        <form class = "form-group" id = "form1" method="post" action="/test">
            {{csrf_field()}}
            <div class="align-content-center">
                <div>
                    <input placeholder="Nome do teste" name ="nick" class = "form-control">
                </div>

                <div>
                    <input class = "form-control" type="number" placeholder="Subject ID" required name="subject_id" >
                </div>

                <div>
                    <input class = "form-control" type="number" placeholder="GradeClass ID" required name="grade_class_id" >
                </div>

                <div>
                    <button type = "submit" class="btn btn-primary">Cadastrar teste</button>
                </div>
            </div>

        </form>
    </div>
@endsection
