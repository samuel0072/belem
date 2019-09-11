@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('content')

    <div class="class-acess">
        <ul class="list-group">
            @foreach($schools as $school)
                <li>
                    <div>
{{--                        <img class="school-image" src="{{$school->image}}">--}}
                        <h1>{{$school->name}}</h1>
                        <h3>{{$school->description}}</h3>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
