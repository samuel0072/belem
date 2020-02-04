var questions = [];//nao sei pra q serve, mas deixa ai
var quest_id = [];
var topics = [];


/*
* Pra plotar os graficos menores
*
* */
/*{label: String, value:Number}*/
function getQues(test_id, subject_id) {
    console.log('aff');

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.open('get', '/test/'+test_id+'/questions', true);
    xmlHttp.onload= function (){
        if(this.readyState === 4 && this.status === 200) {
            res = JSON.parse(this.responseText);
            res.forEach((question) => {
                quest_id.push(question.id);
            });
            topicData(test_id, subject_id);
        }
    };
    xmlHttp.send();
}
function topicData(test_id, subject_id) {

    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/subject/'+subject_id+'/topics', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            topics = JSON.parse(this.responseText);
            var length =Math.round(topics.length/6);
            var topics1 = topics.slice(0, length);
            var topics2 = topics.slice(length, (2*length));
            var topics3 = topics.slice(2*length, (3*length));
            var topics4 = topics.slice((3*length), (4*length));
            var topics5 = topics.slice((4*length), (5*length));
            var topics6 = topics.slice((5*length), (6*length)+1);

            plotData(test_id, topics1, "topics-graphic1");
            plotData(test_id, topics2, "topics-graphic2");
            plotData(test_id, topics3, "topics-graphic3");
            plotData(test_id, topics4, "topics-graphic4");
            plotData(test_id, topics5, "topics-graphic5");
            plotData(test_id, topics6, "topics-graphic6");
        }
    };
    ajax.send();
}
function plotData(test_id, topics, elementname) {
    var data = [];
    topics.forEach(
        (element) => {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", '/test/'+test_id+'/countdesc/'+element.id, true);
            ajax.onload = function() {
                if(this.readyState === 4 && this.status === 200) {
                    response = parseFloat(this.responseText);
                    data.push({label:element.name, value:response});
                    updateGraphic(data, elementname,  "Descritores", "% de acertos");
                }
            };
            ajax.send();
        }
    );

}
function scoreData(test_id) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/test/'+test_id+'/scorecount', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            var rawData = JSON.parse(this.responseText);
            var data = [];

            rawData.forEach((element) => {
               data.push({label:element.name, value:element.count});
            });

            updateGraphic(data, "count-graphic", "Pontuação", "Quantidade");
        }
    };
    ajax.send();
}

/*pra plotar os graficos das questoes*/
function ignite(id) {
    document.getElementById('id'+id).style.display='block';
    getData(id);
}
function getData(question_id) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", '/question/'+question_id+'/option_count', true);
    ajax.onload = function() {
        if(this.readyState === 4 && this.status === 200) {
            var rawData = JSON.parse(this.responseText);
            var data = [];

            rawData.forEach((element)=> {
                element.option_choosed = String.fromCharCode(element.option_choosed+64);
                element.quantity = parseInt(element.quantity);
                data.push({label:element.option_choosed, value:element.quantity});
            });
            updateGraphic(data, "option-quant"+question_id, "letra escolhida", "quantidade");
            console.log("option-quant"+question_id);
        }
    };
    ajax.send();
}

function updateGraphic(data, graph_id, xcaption, ycaption) {

    var svg = d3.select("#"+graph_id);
    d3.selectAll("#"+graph_id+" > *").remove();

    var padding = {top:20, right:30, bottom:30, left:50};
    var colors = d3.schemePaired;
    var chartArea = {
        "width":parseInt(svg.style("width")) - padding.left - padding.right,
        "height":parseInt(svg.style("height")) - padding.top - padding.bottom
    };

    var yScale = d3.scaleLinear()
        .domain([ 0, d3.max(data, (d, i) => { return d.value; }) ] )
        .range( [ chartArea.height, 0 ] ).nice();
    var xScale = d3.scaleBand()
        .domain( data.map( (d) => { return d.label } ) )
        .range([0, chartArea.width])
        .padding(.2);


    var grid = svg.append("g")
        .attr("class", "grid" )
        .attr('transform', 'translate(' + padding.left + ',' + padding.top + ')' )
        .call(d3.axisLeft(yScale).tickSize(-(chartArea.width)).tickFormat(""));

    var xAxisFn = d3.axisBottom(xScale);
    var xAxis = svg.append("g")
        .classed("xAxis", true)
        .attr('transform', 'translate('+ padding.left +', '+ (chartArea.height+padding.top) +')');
    xAxisFn(xAxis);

    var yAxisFn = d3.axisLeft(yScale);
    var yAxis = svg.append("g")
        .classed("yAxis", true)
        .attr(
            'transform', 'translate('+padding.left+', '+padding.top+')'
        );
    yAxisFn(yAxis);
    var rectGrp = svg.append("g").attr(
        'transform', 'translate('+padding.left+', '+padding.top+')'
    );

    rectGrp.selectAll("rect").data(data).enter()
        .append("rect")
        .attr("width", xScale.bandwidth())
        .attr("height", (d, i) => { return chartArea.height - yScale(d.value) })
        .attr("x", (d, i) => { return xScale(d.label)} )
        .attr("y", (d, i) => { return yScale(d.value)} )
        .attr("fill", (d, i) => { return colors[i%12]} );

    svg.append("text")
        .attr("x", ((chartArea.width + padding.left + padding.right) / 2))
        .attr("y", chartArea.height + padding.bottom+padding.top - 3)
        .attr("text-anchor", "middle")
        .style('fill', 'white')
        .style("font-size", "16px")
        .text(xcaption);

    //16 pq o texto tem tamanho de 16px
    svg.append("text")
        .attr("transform", "translate(16, " +((chartArea.height + padding.bottom+padding.top)/2 )+") rotate(-90)")
        .attr("text-anchor", "middle")
        .style('fill', 'white')
        .style("font-size", "16px")
        .text(ycaption)

}

/*
* Aqui para plotar o grafico maior que é atividado
* quando o boão expandir é apertado
*
* */

function start(test_id, _div, _svg, _card, _close, plotfunction, subject_id) {
    var div = $("#"+_div);
    var svg = $("#"+_svg);
    var card = $("#"+_card);
    var close = $("#"+_close);

    var screenWidth = $(window).width();
    var screenHeight = $(window).height();


    div.css("display", "block");
    div.css("position", "fixed");
    div.css("top", 0);
    div.css("left", 0);
    div.css("z-index", 100);
    div.css("background-color", "rgba(0, 0, 0, 0.4)");
    div.css("width", screenWidth);
    div.css("height", screenHeight);

    card.css("width", screenWidth * 0.97);
    card.css("left", 20);


    svg.attr("height", screenHeight * 0.6);
    svg.attr("width", screenWidth * 0.97);

    close.css("position", "absolute");
    close.css("padding", "8px 16px");
    close.css("right", 0);
    close.css("top", 0);
    close.css("background-color", "#ccc");
    close.css("font-size", "18px");
    close.css("text-align", "center");
    close.css("cursor", "pointer");

    if(svg.children().length < 1) {
        plotfunction(test_id, topics, _svg, subject_id);
    }


}

