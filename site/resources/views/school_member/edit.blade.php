<div>
    <h1>Editar</h1>
    <div class="form-group">
        <form method="post" action="/schoolmember/{{$schoolMember->id}}">
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
                <div>
                    <input name="grade_class_id" value="{{$schoolMember->grade_class_id}}" type="hidden">
                </div>
            </div>

            <div>
                <button class="btn btn-primary" type="submit" class="form-control">Salvar dados</button>
            </div>
        </form>
    </div>

    <div class="form-group">
        <form method="post" action="/schoolmember/{{$schoolMember->id}}">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <div>
                <button class="btn btn-danger" type="submit">Excluir Aluno</button>
            </div>
        </form>
    </div>

</div>
