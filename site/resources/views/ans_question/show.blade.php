@extends("layouts.layout")

@section('title', 'Ans_question')

@section('logo')
    <img class="logo" src="{{$school->logo}}" />
@endsection

@section('content')

    <div>
        <h1>{{$ans_question->ans_test_id}}</h1>
        <h3>{{$ans_question->question_id}}</h3>
        <h3>{{$ans_question->option_choosed}}</h3>
    </div>

    <div class="navigator-route">

    </div>
@endsection
