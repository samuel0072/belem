<a onclick="ignite({{$question->id}})" class="list-group-item active text-white">{{$question->nick}}</a>

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
            </div>
        </div>
    </div>
</div>




