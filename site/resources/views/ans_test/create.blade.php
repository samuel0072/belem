<div class="card">
    <div class="card-header">
        <h1>Criar</h1>
    </div>
    <div class="card-body">
        <form method="post" action="/answered_test">
            {{csrf_field()}}
            <div class="form-group mx-sm-3 mb-2">
                <!-- todo:jhonnye -->
                <input class="form-control" type="number" placeholder="Teste-ID" required name="test_id">
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
