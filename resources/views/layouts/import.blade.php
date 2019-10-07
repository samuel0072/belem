<!-- Trigger/Open the Modal -->
<button onclick="document.getElementById('csv').style.display='block'"
        class="btn">IMPORTAR DADOS</button>
<!-- The Modal -->
<div id="csv" class="w3-modal text-dark">
    <div class="w3-modal-content">
        <div class="w3-container">
          <span onclick="document.getElementById('csv').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <div class="container">
                <div class="card-header">
                    <span>Importar Dados para os graficos</span>
                </div>
                <div class="card-body">
                    <span>Como funciona?</span>
                    <p>Os dados são as respostas dos alunos a prova. Exemplo: Aluno x respondeu esta prova,
                        logo, suas respostas são o tipo de dado usado</p>
                    <p>O formato de arquivo que deve estar esses dados é <a href="https://rockcontent.com/blog/csv/" target="_blank">.csv(CLIQUE AQUI PARA LER SOBRE CSV)</a></p>
                    <p>Ou seja, deve estar organizado assim:</p>
                    <p>matriculadoaluno, respostaquestão1, respostaquestão2, ...</p>
                    <p>As questões devem estar na ordem que são aprensetadas na tela anterior!!</p>
                    <span>Exemplo:</span>
                    <p>matriculadoaluno, respostaquestão1, respostaquestão2<br/>
                        53749,a,b<br/>
                        84747,c,d</p>
                    <span>SELECIONE O ARQUIVO</span>

                    <input type="file" id = "input-csv" onchange="getRawData(this.files)">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var token = '{{csrf_token()}}';

    var test_id = {{$test->id}};
    var reader = new FileReader();
    reader.onload = (evt) => {
        var csvText = evt.target.result;
        var csvObject = $.csv.toObjects(csvText);
        doIt(csvObject);
    };

    function getRawData(inputFile) {
        var rawCsv = inputFile[0];
        reader.readAsText(rawCsv);
    }

    function doIt(csv) {
        csv.forEach((element) => {
            var obj = Object.values(element);
            var resp = obj.slice(1);
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
                if(res !== []) {
                    sendData(res.id, resp)
                }
            }
        };
        ajax.send();
    }

    function sendData(student_id, resp) {
        quest_id.forEach(function(element, index) {
            console.log(resp[index]);
            createAns(student_id, resp[index], element)
        });
    }

    function createAns(st_id, option, question_id) {
        option = option.toUpperCase().charCodeAt(0) - 64;

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "/answered_test/", true);
        ajax.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200){
                var resp = JSON.parse(this.responseText);
                createAnsques(resp.id, option, question_id);
            }
        };
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("test_id="+test_id+"&school_member_id="+st_id+"&score=0&done=0&_token="+token);
    }
    function createAnsques(ans_id, option, question_id) {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "/question_answered_test/", true);
        ajax.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                console.log("AHBDFSABAIFBABFHAFBIAEBFIABFAIBF PORRA");
            }
        };
        console.log(token);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("answered_test_id="+ans_id+"&question_id="+question_id+"&option_choosed="+option+"&_token="+token);
    }


</script>
