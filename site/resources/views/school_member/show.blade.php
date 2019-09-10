@extends("layouts.layout")

@section('title', 'school')

@section('content')
   <div class="main-container">
       <img src="{{$student->image}}">
       <footer>
           <strong>{{$student->name}}</strong>
           <div class="student-info">
               <ul>
                   <li>{{$student->school}}</li>
                   <li>{{$student->enroll}}</li>
                   <li>{{$student->score}}</li>
                   <li>{{$student->class}}</li>
                   <li>{{$student->age}}</li>
               </ul>
           </div>
       </footer>

   </div>

    <div class="student-tests">
        <ul>
            @foreach($student->tests as $test)
                <li>
                    {{$test->nick}}
                    {{$test->subject_id}}
                    {{$test->score}}
                    {{$test->status}}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
