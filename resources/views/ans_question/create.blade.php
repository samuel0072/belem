<button onclick="document.getElementById('id21').style.display='block'"
        class="btn btn-primary btn-sm fas fa-eye"></button>

<div id="id21" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
      <span onclick="document.getElementById('id21').style.display='none'"
            class="w3-button w3-display-topright text-white">&times;</span>
            @php
                $questions = [];
            @endphp
            @if($answeredTest != null && $answeredTest->test != null && $answeredTest->test->questions != null)
                @php
                    $questions = $answeredTest->test->questions;
                @endphp
            @endif
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
                                    @php
                                        $option_choosed = chr($answeredTest->opt_choosed($question->id) + 64);
                                    @endphp
                                    <input class="form-control" id="{{$question->id}}"  name="option_choosed" value="{{$option_choosed}}">
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
        const ids = [];
        const values = [];
        @foreach($questions as $question)
            ids.push({{$question->id}});
        @endforeach
        for(let i = 0; i < ids.length; i++ ) {
            values.push( {
                answered_test_id:{{$answeredTest->id}} ,
                question_id: ids[i],
                option_choosed: document.getElementById(ids[i]).value.toUpperCase().charCodeAt(0) - 64
            });
        }
        values.forEach((item) => {
            const ajax = new XMLHttpRequest();
            ajax.open("POST", "/question_answered_test", true);
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(item);
                    updateDone();
                }
            };
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("answered_test_id="+item.answered_test_id+"&question_id="+item.question_id+"&option_choosed="+item.option_choosed+"&_token="+"{{csrf_token()}}");
        });
        document.getElementById('id21').style.display='none';

    }
    function updateDone() {
        @php
            $answeredTest->done = 0;
            $answeredTest->score = 0;
            $answeredTest->update();
        @endphp
    }
</script>


