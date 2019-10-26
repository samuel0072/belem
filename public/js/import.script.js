var reader = new FileReader();
var token;
var test_id;
var class_id;

function settoken(newtoken) {
    token = newtoken;
}
function settest(newId) {
    test_id = newId;
}
function setclassid(newid ) {
    class_id = newid;
}

reader.onload = function(evt){
    var csvText = evt.target.result;
    var csvObject = $.csv.toObjects(csvText);
    doIt(csvObject);
};

function getRawData(inputFile, token_, test_id, class_id) {

    settoken(token_);
    settest(test_id);
    setclassid(class_id);

    var rawCsv = inputFile[0];
    reader.readAsText(rawCsv);
}

function doIt(csv) {
    csv.forEach((element) => {
        var obj = Object.values(element);
        var resp = obj.slice(1);
        console.log(resp);
        var enroll = obj[0];
        getStudent(enroll, resp);
    });
}
function getStudent(enroll, resp) {

    var ajax = new XMLHttpRequest();
    ajax.open("get", "/schoolmember/"+enroll+"/findbyenroll", true);
    ajax.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200){
            var res = JSON.parse(this.responseText);
            console.log(res);
            if(res != []) {
                createAns(res[0].id, resp)
            }
        }
    };
    ajax.send();
}

function createAns(st_id, resp) {
    console.log(option);
    var c = option[0].toUpperCase() - 64;

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "/answered_test/", true);
    ajax.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200){
            var resp = JSON.parse(this.responseText);
            createAnsques(resp.id, resp);
        }
    };
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("test_id="+(test_id)+
        "&grade_class_id="+class_id+
        "&school_member_id="+(st_id)+
        "&score=0&done=0&_token="+(token));
}
function createAnsques(ans_id, resp) {
    quest_id.forEach(function(element, index) {
        var option = resp[index];
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "/question_answered_test/", true);
        ajax.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                console.log("ok");
            }
        };
        console.log(token);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("answered_test_id="+ans_id+
            "&question_id="+element+
            "&option_choosed="+option+
            "&grade_class_id="+class_id+
            "&_token="+token);
    });
}
