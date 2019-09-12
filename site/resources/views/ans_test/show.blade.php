@extends("layouts.layout")

@section('title', 'Ans_Test')

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
        <table class="list-group">
            <thead>
            <td>Questão</td>
            <td>Opção marcada</td>
            </thead>
            <tbody>
            @foreach($answeredTest->questionAnsweredTests as $question)
                <tr>
                    <td>{{$question->question_id}}</td>
                    <td>{{$question->option_choosed}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </li>
    </div>
@endsection
