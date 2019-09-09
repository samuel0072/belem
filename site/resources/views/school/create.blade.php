@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/school">
            {{csrf_field()}}
            <div>
                <input type = "text" placeholder="nome da escola" required name ="name">
            </div>
            <div>
                <button type = "submit">Criar esta escola</button>
            </div>
        </form>
    </div>
@endsection
