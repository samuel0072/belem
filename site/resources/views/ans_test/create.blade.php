@extends('layouts.layout')

@section('title', 'Ans_test')

@section('content')
    <form method="post" action="/answered_test"> //rotas
        <div>
            <label>
                <input type="number" placeholder="Teste-ID" required name="test_id">
            </label>
        </div>

        <div>
            <label>
                <input type="number" placeholder="School Member ID" required name="schoolmember_id">
            </label>
        </div>

        <div>
            <button type = "submit">Cadastrar teste</button>
        </div>

    </form>
@endsection
