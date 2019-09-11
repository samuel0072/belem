@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('content')

    <div class="class-acess">
        <ul class="list-group">
            @foreach($schools as $school)
                <li class="list-group-item">
                    <div>
{{--                        <img class="school-image" src="{{$school->image}}">--}}
                        <ul class="list-group">
                            <a href="/school/{{$school->id}}" class="list-group-item active"><h1>{{$school->name}}</h1></a>
                            <li class="list-group-item text-dark" ><h3>{{$school->description}}</h3></li>
                        </ul>
                        <a href='/grade_class' class="btn btn-mdb-color">Class</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
