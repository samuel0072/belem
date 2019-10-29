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
                    data.push({label:element.name, value:response});
                    updateGraphic(data, "student-describer-graph"+graph_id, "Descritores", "% de acertos");
                    orderTopics(data);
                }
            };
            ajax.send();
        }
    );

}

function orderTopics(topics) {
    topics.sort( (a, b) => {
        if(a.value > b.value) {
            return 1
        }
        else {
            return -1;
        }
    });

    document.getElementById("most-error").innerHTML = topics[0].label;

}
