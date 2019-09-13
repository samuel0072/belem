@extends("layouts.create")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('add_name', 'Escola');

@section('hidden_content')
    <div>
        <form class="form-group" method="post" action="/school">
            {{csrf_field()}}
            <div>
                <input class = "form-control" placeholder="nome da escola" required name ="name">
            </div>

            <div>
                <input class = "form-control" placeholder="descricao da escola" name ="description">
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar esta escola</button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <ul class="list-group">
        @foreach($schools as $school)
            <li class="list-group-item">
                <div>
                    {{--                        <img class="school-image" src="{{$school->image}}">--}}
                    <ul class="list-group">
                        <div class="list-group-item active"><h1>{{$school->name}}</h1></div>
                        <li class="list-group-item text-dark" ><h3>{{$school->description}}</h3></li>
                    </ul>
                    <div class="btn-group">
                        <a href='/school/{{$school->id}}/classes' class="btn btn-mdb-color">Classes</a>
                        @include('school.edit')
                    </div>

                </div>
            </li>
        @endforeach
    </ul>

@endsection




