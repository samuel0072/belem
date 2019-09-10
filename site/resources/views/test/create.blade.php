
@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/answered_test">
            {{csrf_field()}}
            <div>
                <input name = "test_id" placeholder="test_id">
            </div>
            <div>
                <input name = "school_member_id" type="numeric" placeholder="school_member_id">
            </div>
                <button type = "submit">Salvar dados</button>
            </div>
        </form>
    </div>
@endsection
