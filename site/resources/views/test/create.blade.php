@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div class = "form-group">
        <form method="post" action="/test">
            {{csrf_field()}}
            <div class="divider-new align-content-center">
                <label>
                    <input placeholder="Nome do teste" name ="nick" class = "form-control">
                </label>
                <label>
                    <input class = "form-control" type="number" placeholder="Subject ID" required name="subject_id" >
                </label>
                <label>
                    <input class = "form-control" type="number" placeholder="GradeClass ID" required name="grade_class_id" >
                </label>
                <div>
                    <button type = "submit" class="btn btn-primary">Cadastrar teste</button>
                </div>
            </div>

        </form>
    </div>
@endsection
