@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div class = "form-group">
        <form method="post" action="/class/{{$id}}/tests">
            {{csrf_field()}}
            <div>
                <label>
                    <input placeholder="Nome do teste" name ="name" class = "form-control">
                </label>
                <label>
                    <input class = "form-control" type="number" placeholder="Subject ID" required name="subject_id" >
                </label>
            </div>
            <div>
                <button type = "submit" class="btn btn-primary">Cadastrar teste</button>
            </div>
        </form>
    </div>
@endsection
