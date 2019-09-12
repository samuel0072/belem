@extends("layouts.layout")
@section('title', 'Ans_Test')
@section('content')

    <div class = 'card'>
        <div class = "card-body">
            <h1 class = "card-title">{{$student->name}}</h1>
            @foreach($answeredTests as $answeredTest)
                <div class = "table-responsive">
                    <table class="table">
                        <tr>
                            <th>Test ID</th>
                            <th>Nota</th>
                            <th>Corrigido</th>
                            <th>Ultima Atualização</th>
                        </tr>
                        <tr>
                            <td>{{$answeredTest->test_id}}</td>
                            <td>{{$answeredTest->score}}</td>
                            <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                            <td>{{$answeredTest->updated_at}}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>

    </div>

@endsection
