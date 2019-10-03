function topicData2(test_id, graph_id, student_id) {
    var topics = [];
    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/topic', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            topics = JSON.parse(this.responseText);
            plotData2(test_id, topics, student_id, graph_id);
        }
    };
    ajax.send();
}

function plotData2(test_id, topics, student_id, graph_id) {
    var data = [];
    topics.forEach(
        (element) => {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", '/schoolmember/'+student_id+'/test/'+test_id+'/topic/'+element.id, true);
            ajax.onload = function() {
                if(this.readyState === 4 && this.status === 200) {
                    response = parseFloat(this.responseText);
                    data.push({name:element.name, count:response});
                    updateGraphic2(data, "student-describer-graph"+graph_id);
                    orderTopics(data);
                }
            };
            ajax.send();
        }
    );

}

function updateGraphic2(data, graph_id) {
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
