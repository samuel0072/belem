@extends("layouts.layout")

@section(   'title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div>
            <form method="post" action="/belem/site/school_member/{{$schoolMember->id}}">
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <input name = "name" value = "{{$schoolMember->name}}">
                </div>
                <div>
                    <input name = "age" required type="numeric" value = "{{$schoolMember->age}}">
                </div>
                <div>
                    <input name="enroll" type="numeric" value = "{{$schoolMember->enroll}}">
                </div>
                <div>
                    <input name="type" type="text" value = "{{$schoolMember->type}}">
                </div>
                <div>
                    <input name="grade_class_id" type="numeric" value = "{{$schoolMember->grade_class_id}}">
                </div>
                <div>
                    <button type = "submit">Salvar dados</button>
                </div>
            </form>
        </div>
        <div>
            <form method="post" action="/belem/site/school_member/{{$schoolMember->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button type="submit">Excluir alun</button>
                </div>
            </form>
        </div>

    </div>
@endsection
