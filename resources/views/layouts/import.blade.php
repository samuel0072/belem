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

                    <input type="file" id = "input-csv" onchange="getRawData(this.files, '{{csrf_token()}}', {{$test->id}}, {{$test->grade_class_id}})">
                </div>
            </div>
        </div>
    </div>
</div>
