@extends("layouts.create")

@section('title', 'school')

@section('add_name', 'Escola')

@include('school.create')

@section('content')
    <ul class="list-group">
        @foreach($schools as $school)
            <li class="list-group-item">
                <div>
                    <ul class="list-group">
                        <div class="list-group-item active"><h1>{{$school->name}}</h1></div>
                        <li class="list-group-item text-dark"><h3>{{$school->description}}</h3></li>
                    </ul>
                    <div class="btn-group">
                        @include('school.edit')
                    </div>

                </div>
            </li>
        @endforeach
    </ul>

@endsection




