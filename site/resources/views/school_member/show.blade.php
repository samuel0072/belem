@extends("layouts.layout")

@section('title', 'schoolmember')

@section('content')
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
       </footer>

   </div>

    <div>
        <ul class="list-group">
            @foreach($student->answered_tests as $test)
                <li class="list-group-item active">
                    <div>{{$test->nick}}</div>
                    <div>{{$test->subject_id}}</div>
                    <div>{{$test->score}}</div>
                    <div>{{$test->status}}</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
