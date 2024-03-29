@extends("layouts.create")

@section('title', 'Ans_Test')

@section('return', "/schoolmember/$answeredTest->school_member_id")

@section('content')

    <div>
        <h1>{{$answeredTest->subject_id}}</h1>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <td >Questão</td>
                <td>Opção marcada</td>
            <td>{{$answeredTest->student}}</td>
            </thead>
            <tbody>
                @foreach($answeredTest->questionAnsweredTests as $question)
                    <tr>
                        <td>{{$question->question_id}}</td>
                        <td>
                            <form class="form-inline">
                                <div class="form-group mx-sm-3 mb-2"><input class="form-control" name="option_choosed" value="{{chr($question->option_choosed+96)}}">
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </li>
    </div>
@endsection
