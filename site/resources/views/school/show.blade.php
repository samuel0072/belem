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
                            <li class="list-group-item active"><h1>{{$school->name}}</h1></li>
                            <li class="list-group-item text-dark" ><h3>{{$school->description}}</h3></li>
                        </ul>
                        <button class="btn btn-mdb-color">Class</button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
