<div >
    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first"
               aria-selected="true">1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second"
               aria-selected="false">2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third"
               aria-selected="false">3</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth"
               aria-selected="false">4</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="fifith-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth"
               aria-selected="false">5</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth"
               aria-selected="false">6</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-sm"
               onclick="start({{$test_id}},'{{$_graphic}}' , '{{$_svg}}', '{{$_card}}', '{{$_close}}', {{$plotfunction}}, '{{$subject_id}}')"> Expandir</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
            <svg id = "topics-graphic1" width="500" height = "300"></svg>
        </div>
        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
            <svg id = "topics-graphic2" width="500" height = "300"></svg>
        </div>
        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
            <svg  id = "topics-graphic3" width="500" height = "300" ></svg>
        </div>
        <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
            <svg  id = "topics-graphic4" width="500" height = "300" ></svg>
        </div>
        <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
            <svg  id = "topics-graphic5" width="500" height = "300"></svg>
        </div>
        <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
            <svg  id = "topics-graphic6" width="500" height = "300"  onload="{{$func}}({{$test_id}}, {{$subject_id}})" ></svg>
        </div>
    </div>
</div>
