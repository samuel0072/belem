@extends("layouts.layout")

@section('title', 'gradeClass')

@section('content')

   <div class="class-acess">
       <ul class="list-group">
           @foreach($gradeClasses as $class)
               <li class="list-group-item font-weight-bolder text-center active">{{$class->grade_number}}{{$class->class_letter}}</li>
               <li class="list-group-item font-weight-bolder btn-group btn-group-toggle">
                   <a class="btn btn-primary" href="/grade_class/{{$class->id}}/students">Students</a>
                   <a class="btn btn-secondary">Tests</a>
               </li>
           @endforeach
       </ul>
   </div>
@endsection
