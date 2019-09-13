@extends("layouts.layout")
@section('title', 'Ans_Test')
@section('content')

    <div class = 'card'>
        <div class = "card-body">
                    <div class = "table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID do aluno</th>
                                <th>ID da prova</th>
                                <th>Nota</th>
                                <th>Corrigido</th>
                                <th>Ultima Atualização</th>
                            </tr>
                            @foreach($answeredTests as $answeredTest)
                                <tr>
                                    <td>{{$answeredTest->school_member_id}}</td>
                                    <td><a href="/test/{{$answeredTest->test_id}}">{{$answeredTest->test_id}}</a></td>
                                    <td>{{$answeredTest->score}}</td>
                                    <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                                    <td>{{$answeredTest->updated_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
        </div>
    </div>
@endsection
