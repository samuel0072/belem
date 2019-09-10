@extends("layouts.layout")

@section('title', 'Atualizar os dados')

@section('content')
    <div>
        <h1 >Editar</h1>
        <div class = "form-group">
            <form method="post" action="/school_member/{{$schoolMember->id}}"> //TODO: melhorar essa rota
                {{csrf_field()}}
                {{method_field("PATCH")}}
                <div>
                    <label>
                        <input type="number" name="enroll" value="{{$schoolMember->enroll}}" class="form-control">
                    </label>
                    <label>
                        <input class="form-control" name="name" value="{{$schoolMember->name}}">
                    </label>
                    <label>
                        <input type="number" name="age" value="{{$schoolMember->age}}" class="form-control">
                    </label>

                    <label>
                        <select class="browser-default custom-select" name="type">
                            <option value="professor">Professor</option>
                            <option value="aluno">Aluno</option>
                        </select>
                    </label>
                </div>

                <div>
                    <button class="btn btn-primary" type = "submit" class="form-control">Salvar dados</button>
                </div>
            </form>
        </div>

        <div class="form-group">
            <form  method="post" action="/school_member/{{$schoolMember->id}}">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <div>
                    <button class="btn btn-primary" type="submit">Excluir Aluno</button>
                </div>
            </form>
        </div>

    </div>
@endsection
