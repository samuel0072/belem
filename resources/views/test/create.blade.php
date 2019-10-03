@section('hidden_content')
    <div class="card">
        <div class="card-header">
            <h1>Criar Prova</h1>
        </div>
        <div class="card-body">
            <form  id = "form1" method="post" action="/test">
                {{csrf_field()}}
                <div class = "form-group">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="nick">Titulo da prova</label>
                            <input placeholder="Nome da prova" name ="nick" class = "form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="subject_id">Disciplina</label>
                            <select class="browser-default custom-select" name="subject_id">
                                <option selected disabled>Escolha</option>
                                @php
                                    $allsubjects = App\Subject::all();
                                @endphp
                                @foreach($allsubjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input class = "form-control" type="number" placeholder="GradeClass ID" required name="grade_class_id" value = "{{$id}}" hidden>
                    <div class = "form-group">
                        <button type = "submit" class="btn btn-primary">Cadastrar prova</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
