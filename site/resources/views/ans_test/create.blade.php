@extends('layouts.layout')

@section('title', 'Criar')

@section('content')
    <form method="post" action="/answered_test"> //rotas
        <div>
            <label for="test_id">Id do teste</label>
            <input type="number" placeholder="Teste-ID" required name="test_id">

        </div>

        <div>
            <label for="schoolmember_id">School Member Id</label>
            <input type="number" placeholder="School Member ID" required name="schoolmember_id">

        </div>

        <div>
            <button type = "submit">Cadastrar teste</button>
        </div>

    </form>
@endsection
