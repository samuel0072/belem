@section('hidden_content')
    <div class="card">
        <div class="card-header">
            <h1>Criar Teste</h1>
        </div>
        <div class="card-body">
            <form  id = "form1" method="post" action="/test">
                {{csrf_field()}}
                <div class = "form-group">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="nick">Titulo do teste</label>
                            <input placeholder="Nome do teste" name ="nick" class = "form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="subject_id">ID da disciplina</label>
                            <select class="browser-default custom-select" name="subject_id">
                                <option selected disabled>Subject ID</option>
                                @php
                                    $allsubjects = App\Subject::allSubjects();
                                @endphp
                                @foreach($allsubjects as $subject_id)
                                    <option value="{{$subject_id}}">{{$subject_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input class = "form-control" type="number" placeholder="GradeClass ID" required name="grade_class_id" value = "{{$id}}" hidden>
                    <div class = "form-group">
                        <button type = "submit" class="btn btn-primary">Cadastrar teste</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
