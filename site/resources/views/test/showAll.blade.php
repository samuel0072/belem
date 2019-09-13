@extends("layouts.layout")

@section('title', 'Test')

@section('content')
    <div class="student-acess">
        @foreach($tests as $test)
            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <ul class="list-group">
                            <a href= '/test/{{$test->id}}' class="list-group-item active btn btn-sm text-capitalize" ><h1>{{$test->nick}}: {{$test->id}}</h1></a>
                            <li class="list-group-item"><h3>ID do assunto: {{$test->subject_id}}</h3></li>
                        </ul>
                    </div>
                    <a class="btn btn-primary" href="/test/{{$test->id}}/answers">Respostas</a>
                    <a class = "btn btn-warning">Editar</a>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
