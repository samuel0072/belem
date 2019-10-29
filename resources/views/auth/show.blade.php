<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal{{$user->id}}">
    Ver Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="card-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-md-12"><h1 class="modal-title" id="exampleModalLabel">{{$user->name}}</h1></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><h3 >{{$user->email}}</h3></div>
                    <div class="col-md-6"><h3 >{{$user->school->name}}</h3></div>
                </div>

            </div>
            <div class="card-body container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h4>Classes</h4>
                            </div>
                            <div class="card-body">
                                @foreach($user->classes() as $class)
                                    <span class="border-left border-success bg-light text-dark p-2">{{ $class->grade_number}} {{$class->class_letter}}</span>
                                @endforeach
                            </div>
                            <div class="card-footer btn-group ">
                                <button class="btn btn-light text-nowrap">Adicionar</button>
                                <button class="btn btn-danger text-nowrap">Remover</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @php
                            $level = [0 =>"Usuário Comum",
                                      1 => "Professor",
                                      2 => "Diretor",
                                      3 => "Administrador"];
                            $i = 0;
                            while(($i <= $authUser->access_level) && ($i<= 3)) {

                            $i++;
                            }
                        @endphp
                    </div>

                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
