

<button onclick="document.getElementById('id21').style.display='block'"
        class="btn btn-primary btn-sm fas fa-eye"></button>

<div id="id21" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
      <span onclick="document.getElementById('id21').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>

            <!--form method="post" action="/question_ans_test"> //rotas

                <div>
                    <label for="ans_test_id">ID do teste respondido</label>
                    <input type="number" placeholder="Answered Teste-ID" required name="ans_test_id">

                </div>

                <div>
                    <label for="question_id">ID da questao</label>
                    <input type="number" placeholder="Question ID" required name="question_id">

                </div>

                <div>
                    <label for="option_choosed">Opcao escolhida</label>
                    <input type="number" placeholder="Student Answer" required name="option_choosed">

                </div>

                <div>
                    <button type = "submit">Cadastrar questao-respondida</button>
                </div>
            </form-->

            @php
                $questions = $answeredTest->test->questions;
            @endphp
            <div class="card">
                <div class="card-header blue darken-4 text-white">
                    <h1>Respostas</h1>

                </div>
                <div class="card-body">
                    @foreach($questions as $question)
                        <div class="form-inline border-top">
                            <div class="form-group col-sm-4">
                                <label>{{$question->nick}}: {{$question->number}}</label>
                            </div>
                            <div class="form-group col-sm-6" style="margin: 5px 0px 5px 0px;">
                                <div class="form-group">
                                    <input class="form-control" id="{{$question->id}}" type="number" name="option_choosed" value="{{$answeredTest->opt_choosed($question->id)}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button onclick="sendData()" class="btn btn-dark">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendData() {
        var ids = [];
        var values = [];
        @foreach($questions as $question)
            ids.push({{$question->id}});
        @endforeach
        for(var i = 0; i < ids.length; i++ ) {
            values.push( {
                answered_test_id:{{$answeredTest->id}} ,
                question_id: ids[i],
                option_choosed: document.getElementById(ids[i]).value
            });
        }
        console.log(values);
        //todo: excluir tudo em cascata
        values.forEach((item) => {
            var ajax = new XMLHttpRequest();
            ajax.open("POST", "/question_answered_test", true);
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("answered_test_id="+item.answered_test_id+"&question_id="+item.question_id+"&option_choosed="+item.option_choosed+"&_token="+"{{csrf_token()}}");
        });
    }
</script>



