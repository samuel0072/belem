@extends('layouts.create')

@section('add_name', 'Aluno')

@php
    $level = 0;
@endphp


@include('school_member.create', compact('level'))

@section('title', 'schoolmember')

@section('content')
    <div>
        <div class="card">
        @foreach($students as $student)
            <?php
                $id = $student->grade_class->school->id;
            ?>
            @section('return', "/school/$id/classes")
            <div class="card">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="main-container ">
                            <div class="student-info">
                                <div class="text-center text-white list-group-item active">
                                    <strong>{{$student->name}}</strong>
                                </div>
                                <div class = "table-responsive">
                                    <table class = "table">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nº da Matricula</th>
                                            <th>Turma</th>
                                            <th>Idade</th>
                                            <th>Provas feitas</th>
                                        </tr>
                                        <tr>
                                            <td>{{$student->id}}</td>
                                            <td>{{$student->enroll}}</td>
                                            @php
                                                $controller = new \App\Http\Controllers\GradeClassController();
                                                $class = $controller->show($student->grade_class_id);
                                            @endphp
                                            <td>{{"$class->grade_number  $class->class_letter"}}</td>
                                            <td>{{$student->age}}</td>
                                            <td>{{count($student->answeredTests)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                @include('school_member.edit')
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
        </div>
    </div>
@endsection
