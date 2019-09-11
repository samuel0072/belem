@extends('layouts.layout')

@section('title', 'Criar')

@section('content')
    <form method="post" action="/question_ans_test"> //rotas

        <div>
            <label for="ans_test_id">ID do teste respondido</label>
                <input type="number" placeholder="Answered Teste-ID" required name="ans_test_id">

        </div>

        <div>
            <label for="question_id">ID da questao</label>
                <input type="number" placeholder="Question ID" required name="question_id">

        </div>

        <div>
            <label for="option_choosed">Opcao escolhida</label>
                <input type="number" placeholder="Student Answer" required name="option_choosed">

        </div>

        <div>
            <button type = "submit">Cadastrar questao-respondida</button>
        </div>

    </form>
@endsection
