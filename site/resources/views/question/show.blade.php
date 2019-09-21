<a onclick="ignite()" class="list-group-item active text-white">{{$question->nick}}</a>

<!-- The Modal -->
<div id="id{{$question->id}}" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
      <span onclick="document.getElementById('id{{$question->id}}').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
            <div class="card">
                <div class="card-header list-group-item active text-white">
                    <h1>{{$question->nick}}</h1>
                </div>
                <div class="card-body">
                    <svg id="option-quant{{$question->id}}" width="500" height = "300">

                    </svg>
                </div>
                <script>

                    function ignite() {
                        document.getElementById('id{{$question->id}}').style.display='block';
                        getData({{$question->id}});
                    }
                    function getData(question_id) {
                        var ajax = new XMLHttpRequest();
                        ajax.open("GET", '/question/'+question_id+'/option_count', true);
                        ajax.onload = function() {
                            if(this.readyState === 4 && this.status === 200) {
                                rawData = JSON.parse(this.responseText);
                                rawData.map((element)=> {
                                    element.option_choosed = String.fromCharCode(element.option_choosed+64);
                                    element.quantity = parseInt(element.quantity);
                                    console.log(element);
                                    return element;
                                });
                                makeGraphic(rawData, "option-quant{{$question->id}}");
                            }
                        };
                        ajax.send();
                    }
                    function makeGraphic(data, graph_id) {
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
                                return d.quantity;
                            })])
                            .range([chartArea.height, 0]).nice();
                        var xScale = d3.scaleBand()
                            .domain(data.map((d) => {return d.option_choosed}))
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
                                return chartArea.height - yScale(d.quantity)
                            })
                            .attr("x", (d, i) => {return xScale(d.option_choosed)})
                            .attr("y", (d, i) => {return yScale(d.quantity)})
                            .attr("fill", (d, i) => {return colors[i]});

                    }
                </script>
            </div>
        </div>
    </div>
</div>




