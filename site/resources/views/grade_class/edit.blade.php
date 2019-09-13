<div class="w3-container">
    <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-warning ">Editar</button>
    <div id="id03" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h1>Editar</h1>
                <div class="form-group">
                    <form method="post" action="/grade_class/{{$class->id}}">
                        {{csrf_field()}}
                        {{method_field("PATCH")}}
                        <div>
                            <label for="school_id">ID da escola</label>
                            <input class="form-control" type="number" value="{{$class->school_id}}" required
                                   name="school_id">
                        </div>

                        <div>
                            <label for="class_letter">Turma</label>
                            <input class="form-control" value="{{$class->class_letter}}" required name="class_letter">

                        </div>

                        <div>
                            <label for="grade_number">Numero da classe</label>
                            <input class="form-control" type="number" value="{{$class->grade_number}}" required name="grade_number">
                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Salvar dados</button>
                        </div>
                    </form>
                </div>

                <div class="form-group">
                    <form method="post" action="/school_member/{{$class->id}}">
                        {{csrf_field()}}
                        {{method_field("DELETE")}}
                        <div>
                            <button class="btn btn-primary" type="submit">Excluir Classe</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
