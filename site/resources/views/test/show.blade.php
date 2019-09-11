@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$school->logo}}" />--}}
@endsection

@section('content')

    <div>
        <h1>{{$test->nick}}: {{$test->id}}</h1>
        <h3>{{$test->subject_id}}</h3>
    </div>

    <div class="navigator-route">

    </div>

    <div class="student-acess">
        @foreach($test->questions as $question)
            <ul>
                <li>
                    {{$question->nick}}
                    {{$question->topic_id}}
                    {{$question->number}}
                    {{$question->correct_answer}}
                    {{$question->dificult}}
                </li>
            </ul>
        @endforeach
    </div>
@endsection
