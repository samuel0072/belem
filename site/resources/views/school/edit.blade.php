<div style="display:inline" class="w3-container">
    <button onclick="document.getElementById('id{{$school->id}}').style.display='block'"
            class="btn btn-mdb-color ">Editar
    </button>
    <a href='/school/{{$school->id}}/classes' class="btn btn-mdb-color">Classes</a>
    <div >
        <div id="id{{$school->id}}" class="w3-modal w3-animate-left w3-modal-content">
            <div class="w3-container">
                <a onclick="document.getElementById('id{{$school->id}}').style.display='none'"
                   class="w3-button w3-display-topright">&times;</a>

                <div class = "card">
                    <div class="card-header">
                        <h1>Editar</h1>
                    </div>
                    <div class = "card-body">
                        <form class="form-group" method="post" action="/school/{{$school->id}}">
                            {{csrf_field()}}
                            {{method_field("PATCH")}}
                            <div>
                                <input class="form-control" name="name" value="{{$school->name}}">
                            </div>

                            <div>
                                <input class="form-control" name="description"
                                       value="{{$school->description}}">
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-primary" type="submit">Salvar dados</button>
                            </div>
                        </form>
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
    </div>
</div>
