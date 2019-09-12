@extends("layouts.layout")

@section('title', 'schoolmember')

@section('content')
    <div>
        <div class="card">
        @foreach($students as $student)
                <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="main-container ">

                                <div class="student-info">
                                    <div class="text-center text-white list-group-item active">
                                        <strong>{{$student->name}}</strong>
                                    </div>

                                <!--ul class="list-group list-group-horizontal">
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
                                </ul-->
                                    <div class = "table-responsive">

                                        <table class = "table">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nº da Matricula</th>
                                                <th>ID da classe</th>
                                                <th>Idade</th>
                                            </tr>
                                            <tr>
                                                <td>{{$student->id}}</td>
                                                <td>{{$student->enroll}}</td>
                                                <td>{{$student->grade_class_id}}</td>
                                                <td>{{$student->age}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a class="btn btn-grey" href="/schoolmember/{{$student->id}}/ans_tests">Tests</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

            @endforeach
        </div>
    </div>
@endsection
