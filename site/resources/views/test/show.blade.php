@extends("layouts.layout")

@section('title', 'school')

<?php
 $id = $test->gradeClass->id;
?>
@section('return' ,"/grade_class/$id/tests")

@section('content')
    <div class="text-white">
        <h1>{{$test->nick}}: {{$test->id}}</h1>
    </div>

    <div class="navigator-route">

    </div>
    <?php
        $ar = array(
            "f" => "fácil",
            "m" => "médio",
            "d" => "difícil"
        );
    ?>

    <div class="student-acess">
        <section id = "left" class="float-left text-white">
            <p >Nenhum gráfico disponivel por enquanto</p>
            <svg id = "topics-graphic" width="500" height = "300" onload="topicData()"></svg>
        </section>
        <section id = "right" class="float-right">
            <div class="card">
                <div class="card-header">
                    <h1>Questoes</h1>
                    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button deep-purple darken-4 text-white">Adicionar</button>
                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content">
                            <div class="w3-container"> <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                @include("question.create")
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "card-body">
                    <ul class="list-group">
                        @foreach($test->questions as $question)
                            <a href="/question/{{$question->id}}"  class="list-group-item active text-white">
                                {{$question->nick}}
                            </a>
                            <li style="list-style:none">
                                <table class = "table">
                                    <tr>
                                        <th>ID do topico</th>
                                        <th>Número da questão</th>
                                        <th>Resposta correta</th>
                                        <th>Dificuldade</th>
                                    </tr>
                                    <tr>
                                        <td>{{$question->topic_id}}</td>
                                        <td>{{$question->number}}</td>
                                        <td>{{chr($question->correct_answer+96)}}</td>
                                        <td>{{$ar[$question->dificult]}}</td>
                                    </tr>
                                </table>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </section>

    </div>
    <script>

        function topicData() {
            var topics = [];
            var ajax = new XMLHttpRequest();
            ajax.open("GET", '/topic', true);
            ajax.onload = function() {
                if(this.readyState === 4 && this.status === 200) {
                    topics = JSON.parse(this.responseText);
                    plotData({{$test->id}}, topics);
                }
            };
            ajax.send();
        }

        function plotData(test_id, topics) {
            var data = [];
            topics.forEach(
                (element) => {
                    var ajax = new XMLHttpRequest();
                    ajax.open("GET", '/test/'+test_id+'/countdesc/'+element.id, true);
                    ajax.onload = function() {
                        if(this.readyState === 4 && this.status === 200) {
                            response = parseFloat(this.responseText);
                            data.push({name:element.name, count:response});
                            updateGraphic(data, "topics-graphic");
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

            console.log(yScale);
            console.log(xScale.range);

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
    </script>
@endsection
