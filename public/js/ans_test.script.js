var ids = [];


function corrigir(id, token) {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", '/test/'+id+'/correct', true);
    ajax.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log("tudo okay");
        }
    };
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("_token="+token);
}


function populateIds(ID) {
    ids.push(ID);

}
function sendData(answeredTest, questions,token) {
    answeredTest = JSON.parse(answeredTest);
    questions = JSON.parse(questions);


    var values = [];
    for(let i = 0; i < questions.length; i++ ) {
        values.push( {
            answered_test_id:answeredTest.id ,
            question_id: questions[i].id,
            option_choosed: document.getElementById(questions[i].id).value.toUpperCase().charCodeAt(0) - 64,
            grade_class_id: answeredTest.grade_class_id
        });
    }
    console.log(answeredTest, questions, values);
    values.forEach((item) => {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "/question_answered_test", true);
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                updateDone(answeredTest, token);
            }
        };
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("grade_class_id="+item.grade_class_id+"&answered_test_id="+item.answered_test_id+"&question_id="+item.question_id+"&option_choosed="+item.option_choosed+"&_token="+token);
    });

    document.getElementById('id21').style.display='none';

}
function updateDone(answeredTest, token) {
    const ajax = new XMLHttpRequest();
    ajax.open("PUT", "/answered_test", true);
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("mehh");
        }
    };
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send('_token='+token+
        "&test_id="+answeredTest.test_id+
        "&grade_class_id="+answeredTest.grade_class_id+
        "&school_member_id="+answeredTest.school_member_id+
        "&score=0&done=0");
}
