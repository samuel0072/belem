@extends("layouts.create")

@section('title', 'Test')

@section('add_name', 'Teste')

@include('test.create')

@section('content')
    <div class="student-acess">
        @foreach($tests as $test)
            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <ul class="list-group">
                            <a href= '/test/{{$test->id}}' class="list-group-item active btn btn-sm text-capitalize" ><h1>{{$test->nick}}: {{$test->id}}</h1></a>
                            <li class="list-group-item"><h3>Disciplina: {{$test->subject->name}}</h3></li>
                        </ul>
                    </div>
                    <?php
                        $answeredTests = $test->answeredTest;
                    ?>
                    @include('ans_test.showAll', compact('answeredTests'))
                </li>
            </ul>
        @endforeach
    </div>

    <script>

    </script>
@endsection
