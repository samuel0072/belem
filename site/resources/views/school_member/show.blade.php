@extends("layouts.create")

@section('add_name', 'Teste Resp.')

<?php
    $id = $student->grade_class->id;
    $studentId = $student->id;
    $level = 0;
?>

@section('hidden_content')
    @include("ans_test.create", compact(['studentId', 'level']))
@endsection

@section('return', "/grade_class/$id/students")

@section('title', 'schoolmember')

@section('content')
    <div>
        <div class="card float-left">
            <strong class=" list-group-item active text-center">{{$student->name}}</strong>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ID do aluno</th>
                        <th>Nº de matricula</th>
                        <th>Classe</th>
                        <th>Idade</th>
                        <th>Score total</th>
                    </tr>
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->enroll}}</td>
                        <td>{{$student->grade_class->grade_number." "}}{{$student->grade_class->class_letter}}</td>
                        <td>{{$student->age}}</td>
                        <td>0</td>
                    </tr>
                </table>

            </div>
            <div id="lower-element" class="card">
                <div class="card-header">
                    <label>GRAFICOS</label>
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class = "card-body">
                    <!--ate 1200px -->
                    <svg id = "student-describer-graph" onload="topicData(1)"  width="500" height = "300" class="d-sm-block">

                    </svg>
                </div>
            </div>
        </div>
        <div class = "card float-right">
            <h1 class = " list-group-item active text-center" style="margin-top: 0px;">Testes respondidos</h1>
            <div class = "table-responsive">
                <table class="table">
                    <tr>
                        <th>Prova</th>
                        <th>Nota</th>
                        <th>Corrigido</th>
                        <th>Ultima Atualização</th>
                        <th>Visualizar</th>
                    </tr>
                    @foreach($student->answeredTests as $answeredTest)
                        <tr>
                            <td><a href="/test/{{$answeredTest->test_id}}">{{App\Test::findOrFail($answeredTest->test_id)->nick}}</a></td>
                            <td>{{$answeredTest->score}}</td>
                            <td>{{$answeredTest->done == 1?'Sim':'Não'}}</td>
                            <td>{{$answeredTest->updated_at}}</td>
                            <td >@include("ans_question.create", compact('answeredTest'))</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div id="topic-critic" class = "danger-color container shadow-sm p-3 bg-white rounded">
                <div class="row">
                    <h1 class="col-sm">ATENÇÃO</h1>
                </div>
                <div>
                    <span id = "most-error" ></span>
                    <span>é o descritor com mais erros pelo aluno</span>
                </div>

            </div>

        </div>

    </div>

    <script>
        function topicData(test_id) {
            var topics = [];
            var ajax = new XMLHttpRequest();
            ajax.open("GET", '/topic', true);
            ajax.onload = function() {
                if(this.readyState === 4 && this.status === 200) {
                    topics = JSON.parse(this.responseText);
                    plotData(test_id, topics, {{$student->id}});
                }
            };
            ajax.send();
        }

        function plotData(test_id, topics, student_id) {
            var data = [];
            topics.forEach(
                (element) => {
                    var ajax = new XMLHttpRequest();
                    ajax.open("GET", '/schoolmember/'+student_id+'/test/'+test_id+'/topic/'+element.id, true);
                    ajax.onload = function() {
                        if(this.readyState === 4 && this.status === 200) {
                            response = parseFloat(this.responseText);
                            data.push({name:element.name, count:response});
                            updateGraphic(data, "student-describer-graph");
                            orderTopics(data);
                        }
                    };
                    ajax.send();
                }
            );

        }

        function updateGraphic(data, graph_id) {
            var svg = d3.select("#"+graph_id);
            d3.selectAll("#"+graph_id+" > *").remove();
            var padding = {top:20, right:30, bottom:30, left:50};
            var colors = d3.schemeCategory10;
            var chartArea = {
                "width":parseInt(svg.style("width")) - padding.left - padding.right,
                "height":parseInt(svg.style("height")) - padding.top - padding.bottom
            };

            var yScale = d3.scaleLinear()
                .domain([0, d3.max(data, (d, i) => {
                    return d.count;
                })])
                .range([chartArea.height, 0]).nice();
            var xScale = d3.scaleBand()
                .domain(data.map((d) => {return d.name}))
                .range([0, chartArea.width])
                .padding(.2);

            var grid = svg.append("g")
                .attr("class", "grid")
                .attr(
                    'transform', 'translate('+padding.left+','+padding.top+')'
                )
                .call(
                    d3.axisLeft(yScale).tickSize(-(chartArea.width)).tickFormat("")
                );

            var xAxisFn = d3.axisBottom(xScale);
            var xAxis = svg.append("g")
                .classed("xAxis", true)
                .attr(
                    'transform', 'translate('+padding.left+', '+(chartArea.height+padding.top)+')'
                );
            xAxisFn(xAxis);


            var yAxisFn = d3.axisLeft(yScale);
            var yAxis = svg.append("g")
                .classed("yAxis", true)
                .attr(
                    'transform', 'translate('+padding.left+', '+padding.top+')'
                );
            yAxisFn(yAxis);

            //
            var rectGrp = svg.append("g").attr(
                'transform', 'translate('+padding.left+', '+padding.top+')'
            );

            rectGrp.selectAll("rect").data(data).enter()
                .append("rect")
                .attr("width", xScale.bandwidth())
                .attr("height", (d, i) => {
                    return chartArea.height - yScale(d.count)
                })
                .attr("x", (d, i) => {return xScale(d.name)})
                .attr("y", (d, i) => {return yScale(d.count)})
                .attr("fill", (d, i) => {return colors[i]});
            svg.style("border-style: solid;border-width: 5px;");

        }

        function orderTopics(topics) {
            topics.sort( (a, b) => {
                if(a.count > b.count) {
                    return 1
                }
                else {
                    return -1;
                }
            });
            console.log(topics);
            console.log(topics[0].name);
            document.getElementById("most-error").innerHTML = topics[0].name;

        }

    </script>

@endsection










































