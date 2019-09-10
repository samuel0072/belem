@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/class/{{$id}}/tests">
            {{csrf_field()}}
            <div>
                <input type = "text" placeholder="Nome do teste" name ="name">
            </div>
            <div>
                <button type = "submit">Criar esta escola</button>
            </div>
        </form>
    </div>
@endsection
