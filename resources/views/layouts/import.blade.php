<!-- Trigger/Open the Modal -->
<button onclick="document.getElementById('csv').style.display='block'"
        class="btn">IMPORTAR DADOS</button>
<!-- The Modal -->
<div id="csv" class="w3-modal text-white ">
    <div class="w3-modal-content">
        <div class="w3-container">
          <span onclick="document.getElementById('csv').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <div class="card">
                <div class="card-header stylish-color" >
                    <span>Importar Dados para os graficos</span>
                </div>
                <div class="card-body stylish-color-dark">
                   <span class="border bg-primary ">CSV</span>
                    <span class="border bg-secondary">Excel</span>

                    <input type="file" id = "input-csv" onchange="getRawData(this.files, '{{csrf_token()}}', {{$test->id}}, {{$test->grade_class_id}})">
                </div>
            </div>
        </div>
    </div>
</div>
