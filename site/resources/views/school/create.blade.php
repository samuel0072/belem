@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/school">
            {{csrf_field()}}
            <div>
                <input class = "form-control" placeholder="nome da escola" required name ="name">
            </div>

            <div>
                <input class = "form-control" placeholder="descricao da escola" name ="description">
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar esta escola</button>
            </div>
        </form>
    </div>
@endsection
