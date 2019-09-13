@extends('layouts.layout')

@section('title', 'Criar')

@section('content')
    <form method="post" action="/answered_test">
        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" type="number" placeholder="Teste-ID" required name="test_id">
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" type="number" placeholder="School Member ID" required name="schoolmember_id">
        </div>

        <div>
            <button class="btn btn-primary" type = "submit">Cadastrar teste</button>
        </div>

    </form>
@endsection
