@php
    $current_user = auth()->user();
    $users = $current_user->showUsers( $id, $current_user->id);
@endphp

<div class="w3-container">
    <a class="btn btn-primary" href="/grade_class/{{$class->id}}/students">Alunos</a>
    <a class="btn btn-secondary" href="/grade_class/{{$class->id}}/tests">Provas</a>

    @if(auth()->user()->access_level > 1)
        <button onclick="document.getElementById('grade{{$class->id}}3').style.display='block'" class="btn btn-warning ">Editar</button>
        <div id='grade{{$class->id}}3' class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('grade{{$class->id}}3').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <div class = "card">
                        <div class="card-header"><h1>Editar</h1></div>
                        <div class="card-body">
                            <div class="form-group">
                                <form method="post" action="/grade_class/{{$class->id}}">
                                    {{csrf_field()}}
                                    {{method_field("PATCH")}}
                                    <div>
                                        <input class="form-control" type="number" value="{{$class->school_id}}" required
                                               name="school_id" hidden>
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
                                <form method="post" action="/grade_class/{{$class->id}}">
                                    {{csrf_field()}}
                                    {{method_field("DELETE")}}
                                    <div>
                                        <button class="btn btn-red" type="submit">Excluir Classe</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-danger" onclick="document.getElementById('grade{{$class->id}}4').style.display='block'" >Adicionar professor</button>
        <div id="grade{{$class->id}}4" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('grade{{$class->id}}4').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <ul>
                        @foreach($users as $user)
                            <li>
                                {{$user->name}}
                                <form action="/user_class" method="post">
                                    {{csrf_field()}}
                                    <input name="grade_class_id" value="{{$class->id}}" hidden>
                                    <input name="user_id" value="{{$user->id}}" hidden>
                                    <button type="submit">Adicionar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
