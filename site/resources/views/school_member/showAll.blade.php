@extends("layouts.layout")

@section('title', 'school')

@section('content')
    <div>
        <ul class="list-group">
            @foreach($students as $student)
                <li class="list-group-item active">
                    <div class="main-container">
                        <img src="{{$student->image}}">
                        <footer class="page-footer font-small blue pt-4">
                            <strong>{{$student->name}}</strong>
                            <div class="student-info">
                                <ul class="list-group">
                                    <li class="list-group-item active">{{$student->school}}</li>
                                    <li class="list-group-item">{{$student->enroll}}</li>
                                    <li class="list-group-item">{{$student->score}}</li>
                                    <li class="list-group-item">{{$student->class}}</li>
                                    <li class="list-group-item">{{$student->age}}</li>
                                </ul>
                            </div>

                            <button class="btn btn-primary">Tests</button>
                        </footer>

                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
