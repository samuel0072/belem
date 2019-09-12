@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('content')

    <div class="class-acess" >
        <div>
            <a href="/school/create" class="btn btn-mdb-color">Adicionar</a>
        </div>
        <ul class="list-group">
            @foreach($schools as $school)
                <li class="list-group-item">
                    <div>
{{--                        <img class="school-image" src="{{$school->image}}">--}}
                        <ul class="list-group">
                            <a href="/school/{{$school->id}}" class="list-group-item active"><h1>{{$school->name}}</h1></a>
                            <li class="list-group-item text-dark" ><h3>{{$school->description}}</h3></li>
                        </ul>
                        <a href='/school/{{$school->id}}/classes' class="btn btn-mdb-color">Classes</a>
                        <a href='/school/{{$school->id}}/edit' class = "btn btn-mdb-color">Editar</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
