<div class="card">
    <div class="card-header">
        <h1>Criar Questão</h1>
    </div>
    <div class="card-body">
        <form id = "create-question" method="post" action="/question">
            {{csrf_field()}}
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        <input placeholder="Titulo da questao" name="nick" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="number">Número da questão</label>
                            <input type="number" placeholder="Numero da questao" required name="number"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group col-md-4 mb-3">
                        
                        <label for="topic_id">Descritor</label>
                        <select class="browser-default custom-select" name="topic_id">
                            <option selected disabled>Escolha</option>
                            @php
                                $alltopics = App\Topic::getSubjectTopics($test->subject_id);
                            @endphp
                            @foreach($alltopics as $topic) 
                                <option value = "{{$topic->id}}">{{$topic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="number" placeholder="Id do teste" required name="test_id" class="form-control"
                       value="{{$test->id}}" hidden>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="option_quant">Quantidade de alternativas</label>
                        <input type="number" placeholder="Quantidade" required name="option_quant" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="correct_answer">Alternativa correta</label>
                        <input  id = "correct-answer" placeholder="Opcao correta" required name="correct_answer"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="dificult"></label>
                <select name="dificult" class="form-control">
                    <option value="f">Facil</option>
                    <option value="m">Medio</option>
                    <option value="d">Dificil</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Cadastrar questao</button>
            </div>
        </form>
    </div>
    <script src="/js/question.script.js"></script>
</div>
