@extends("layouts.layout")

@section('title', 'school')

@section('logo')
    <img class="logo" src="{{$school->logo}}" />
@endsection

@section('content')

    <div>
        <img class="school-image" src="{{$school->image}}">
        <h1>{{$school->name}}</h1>
        <h3>{{$school->description}}</h3>
    </div>

    <div class="navigator-route">

    </div>

    <div class="class-acess">
        @foreach($classes as $class)
            <ul>
                <li>
                    {{$class->number}}
                    {{$class->grade}}
                </li>
            </ul>
        @endforeach
    </div>
   </div>
@endsection
