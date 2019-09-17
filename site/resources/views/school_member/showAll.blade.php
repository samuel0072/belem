@extends('layouts.create')

@section('add_name', 'Aluno')

@include('school_member.create')

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
                                                <th>ID da classe</th>
                                                <th>Idade</th>
                                                <th>Testes feitos</th>
                                            </tr>
                                            <tr>
                                                <td>{{$student->id}}</td>
                                                <td>{{$student->enroll}}</td>
                                                <td>{{$student->grade_class_id}}</td>
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
