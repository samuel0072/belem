@section('hidden_content')
    <div class="card">
        <div class="card-header">
            <h1>
                Criar
            </h1>
        </div>
        <div class="card-body">
            <form class="form-group" method="post" action="/school">
                {{csrf_field()}}
                <div>
                    <input class="form-control" placeholder="Nome da escola" required name="name">
                </div>

                <div>
                    <input class="form-control" placeholder="Descricao da escola" name="description">
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Criar esta escola</button>
                </div>
            </form>
        </div>
    </div>
@endsection
