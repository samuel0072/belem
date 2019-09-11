@extends("layouts.layout")

@section('title', 'school')

@section('logo')
{{--    <img class="logo" src="{{$schools->logo}}" />--}}
@endsection

@section('content')

    <div class="class-acess">
        @foreach($schools as $school)
            <ul class="list-group">
                <li>
                    <div>
                        <img class="school-image" src="{{$school->image}}">
                        <h1>{{$school->name}}</h1>
                        <h3>{{$school->description}}</h3>
                    </div>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
