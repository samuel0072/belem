@php
    $controller = new App\Http\Controllers\AnsweredTestController();
    $questions = $controller->getTestQuestions($answeredTest->id);
@endphp

<button onclick="document.getElementById('ques{{ $answeredTest->id }}').style.display='block'"
        class="btn btn-primary btn-sm fas fa-eye"></button>

<div id="ques{{ $answeredTest->id }}" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
      <span onclick="document.getElementById('ques{{ $answeredTest->id }}').style.display='none'"
            class="w3-button w3-display-topright text-white">&times;</span>

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
                                <div class="form-group" onload="populateIds({{$question->id}})">
                                    @php
                                        $option_choosed = chr($answeredTest->opt_choosed($question->id) + 64);
                                    @endphp
                                    <input class="form-control" id="{{$question->id}}"  name="option_choosed" value="{{$option_choosed}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button onclick="sendData('{{$answeredTest}}','{{$answeredTest->test->questions}}', '{{csrf_token()}}', 'ques{{ $answeredTest->id }}' )" class="btn btn-dark">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>




