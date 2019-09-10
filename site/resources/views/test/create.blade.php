
@extends("layouts.layout")
@section('title', 'CRIAR')

@section('content')
    <div>
        <form method="post" action="/belem/site/school_member">
            {{csrf_field()}}
            <div>
                <input name = "name" placeholder="name">
            </div>
            <div>
                <input name = "age" type="numeric" placeholder="age">
            </div>
            <div>
                <input name="enroll" type="numeric" placeholder="enroll">
            </div>
            <div>
                <input name="type" type="text" placeholder="type">
            </div>
            <div>
                <input name="grade_class_id" type="numeric" placeholder="grade_class_id">
            </div>
            <div>
                <button type = "submit">Salvar dados</button>
            </div>
        </form>
    </div>
@endsection
