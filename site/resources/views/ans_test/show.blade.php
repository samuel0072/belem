@extends("layouts.layout")

@section('title', 'school')

@section('logo')
    <img class="logo" src="{{$school->logo}}" />
@endsection

@section('content')

    <div>
        <h1>{{$ans_test->subject_id}}</h1>
        <h3>{{$ans_test->schoolmember_id}}</h3>
    </div>

    <div class="navigator-route">

    </div>

    <div class="student-acess">
        @foreach($ans_test->questions as $question)
            <ul>
                <li>
                    {{$question->question_id}}
                    {{$question->option_choosed}}
                </li>
            </ul>
        @endforeach
    </div>
@endsection
