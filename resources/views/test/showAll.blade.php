@extends("layouts.create")

@section('title', 'Test')

@section('add_name', 'Prova')

@php
 $level = 0;
@endphp

@include('test.create', compact('level'))

@section('content')
    <div class="student-acess">
        @foreach($tests as $test)
            <?php
                $id = $test->gradeClass->school_id;
            ?>
            @section('return', "/school/$id/classes")

            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <ul class="list-group" style="z-index: -1;">
                            <a href= '/test/{{$test->id}}' class="list-group-item active btn text-capitalize" ><h1>{{$test->nick}}: {{$test->id}}</h1></a>
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
@endsection

