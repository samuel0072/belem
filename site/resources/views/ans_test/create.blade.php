<div class="card">
    <div class="card-header">
        <h1>Criar</h1>
    </div>
    <div class="card-body">
        <form method="post" action="/answered_test">
            {{csrf_field()}}
            <div class="form-group mx-sm-3 mb-2">
                <label for="test_id">ID do Teste</label>
                <select class="browser-default custom-select" name="test_id">
                    <option selected disabled>Test ID</option>
                    @php
                        $allTests = App\Test::allTests();
                    @endphp
                    @foreach($allTests as $test_id)
                        <option value="{{$test_id}}">{{$test_id}}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group mx-sm-3 mb-2">
                <input class="form-control" type="number" placeholder="School Member ID" required
                       name="school_member_id" ,
                       value="{{$studentId}}" hidden>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Cadastrar teste</button>
            </div>
        </form>
    </div>
</div>
