<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal{{$user->id}}">
    Ver Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-1">
                    <div class="row">
                        <div class="col-md-2 ">
                            <span><strong>ID</strong></span>
                            <span>{{$user->id}}</span>
                        </div>
                        <div class="col-md-10">
                            <span><strong>Email</strong></span>
                            <span>{{$user->email}}</span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <span>Nível de acesso</span>
                            <select id = "acc_lvl_select" onchange="alterar({{json_encode($user)}})" class="browser-default custom-select" name="access_level">
                                <option value="{{$user->access_level}}" selected>Selecione</option>
                                @php
                                    $level = [0 =>"Usuário Comum",
                                              1 => "Professor",
                                              2 => "Diretor",
                                              3 => "Administrador"];
                                    $i = 0;
                                    while(($i <= $authUser->access_level) && ($i<= 3)) {
                                        echo "<option value=$i>$level[$i]</option>";
                                        $i++;
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-dark">Inserir em uma classe</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-danger">
                                Remover de uma classe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar Mudanças</button>
            </div>
        </div>
    </div>
</div>
