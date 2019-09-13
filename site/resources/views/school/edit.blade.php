<div class="w3-container">
    <button onclick="document.getElementById('id02').style.display='block'" class="btn btn-mdb-color ">Editar</button>
    <div id="id02" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h1>Editar</h1>
                <div>
                    <form class="form-group" method="post" action="/school/{{$school->id}}">
                        {{csrf_field()}}
                        {{method_field("PATCH")}}
                        <div>
                            <input class="form-control" name="name" value="{{$school->name}}">
                        </div>

                        <div>
                            <input class="form-control" name="description" value="{{$school->description}}">
                        </div>

                        <div class="btn-group">
                            <button class="btn btn-primary" type="submit">Salvar dados</button>
                        </div>
                    </form>
                </div>
                <div>
                    <form class="form-group" method="post" action="/school/{{$school->id}}">
                        {{csrf_field()}}
                        {{method_field("DELETE")}}
                        <div>
                            <button class="btn btn-teal" type="submit">Excluir escola</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
