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
                    <button class="btn btn-primary">Students</button>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
