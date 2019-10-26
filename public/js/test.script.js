var questions = [];//nao sei pra q serve, mas deixa ai
var quest_id = [];

function getQues(test_id) {

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.open('get', '/test/'+test_id+'/questions', true);
    xmlHttp.onload= function (){
        if(this.readyState === 4 && this.status === 200) {
            res = JSON.parse(this.responseText);
            res.forEach((question) => {
                quest_id.push(question.id);
            });
            topicData(test_id);
        }
    };
    xmlHttp.send();
}



function topicData(test_id) {
    var topics = [];
    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/topic', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            topics = JSON.parse(this.responseText);
            plotData(test_id, topics);
        }
    };
    ajax.send();
}

function scoreData(test_id) {
    var data = [];
    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/test/'+test_id+'/scorecount', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            data = JSON.parse(this.responseText);
            updateGraphic(data, "count-graphic");
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

}

//pra plotar os graficos das questoes
function ignite(id) {
    document.getElementById('id'+id).style.display='block';

    getData(id);
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
                return element;
            });
            makeGraphic(rawData, "option-quant"+question_id);
            console.log("option-quant"+question_id);
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
