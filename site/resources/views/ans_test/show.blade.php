@extends("layouts.layout")

@section('title', 'Ans_Test')


@section('content')

    <div>
        <h1>{{$answeredTest->subject_id}}</h1>
        <h3>{{$answeredTest->schoolmember_id}}</h3>
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
                    <td>{{chr($question->option_choosed+96)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </li>
    </div>
@endsection
