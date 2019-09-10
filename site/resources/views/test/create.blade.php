@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/class/{{$id}}/tests">
            {{csrf_field()}}
            <div>
                <label>
                    <input placeholder="Nome do teste" name ="name">
                </label>
                <label>
                    <input type="number" placeholder="Subject ID" required name="subject_id">
                </label>
            </div>
            <div>
                <button type = "submit">Cadastrar teste</button>
            </div>
        </form>
    </div>
@endsection
