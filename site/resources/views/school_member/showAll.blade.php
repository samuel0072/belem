@extends("layouts.layout")

@section('title', 'school')

@section('content')
    <div>
        <ul class="list-group">
            @foreach($students as $student)
                <li class="list-group-item active">
                    <div class="main-container">

                        <footer class="page-footer font-small blue pt-4">
                            <strong>{{$student->name}}</strong>
                            <div class="student-info">
                                <ul class="list-group">
                                    <li class="list-group-item active text-dark">{{$student->id}}</li>
                                    <li class="list-group-item text-dark">{{$student->enroll}}</li>
                                    <li class="list-group-item text-dark">{{$student->score}}</li>
                                    <li class="list-group-item text-dark">{{$student->grade_class_id}}</li>
                                    <li class="list-group-item text-dark">{{$student->age}}</li>
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
