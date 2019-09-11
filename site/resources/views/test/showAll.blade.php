@extends("layouts.layout")

@section('title', 'school')

@section('logo')
    <img class="logo" src="{{$school->logo}}" />
@endsection

@section('content')
    <div class="student-acess">
        @foreach($tests as $test)
            <ul>
                <li>
                    <div>
                        <h1>{{$test->nick}}</h1>
                        <h3>{{$test->subject_id}}</h3>
                    </div>
                    <button class="btn btn-primary">Students</button>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
