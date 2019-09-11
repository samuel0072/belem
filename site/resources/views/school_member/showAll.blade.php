@extends("layouts.layout")

@section('title', 'schoolmember')

@section('content')
    <div>
        <ul class="list-group">
            @foreach($students as $student)
                <li class="list-group-item active">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="main-container ">

                                <div class="student-info">
                                    <div class="text-center black text-white">
                                        <strong>{{$student->name}}</strong>
                                    </div>

                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item text-dark">
                                            <ul class="list-group">
                                                <li class="list-group-item">ID</li>
                                                <li class="list-group-item">{{$student->id}}</li>
                                            </ul>
                                        </li>
                                        <li class="list-group-item text-dark">

                                            <ul class="list-group">
                                                <li class="list-group-item">Nº da Matricula</li>
                                                <li class="list-group-item">{{$student->enroll}}</li>
                                            </ul>
                                        </li>

                                        <li class="list-group-item text-dark">

                                            <ul class="list-group">
                                                <li class="list-group-item">ID da classe</li>
                                                <li class="list-group-item">{{$student->grade_class_id}}</li>
                                            </ul>
                                        </li>

                                        <li class="list-group-item text-dark">

                                            <ul class="list-group">
                                                <li class="list-group-item">Idade</li>
                                                <li class="list-group-item">{{$student->age}}</li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <button class="btn btn-grey">Tests</button>
                                </div>

                            </div>
                        </li>
                    </ul>

                </li>
            @endforeach
        </ul>
    </div>
@endsection
