@extends("layouts.layout")

@section('title', 'gradeClass')

@section('content')

   <div class="class-acess">
       @foreach($gradeClasses as $class)
           <ul class="list-group">
               <li>
                   {{$class->number}}
                   {{$class->grade}}
                   <div class="btn-group btn-group-toggle" data-toggle="buttons">
                       <button class="btn btn-primary">Students</button>
                       <button class="btn btn-secondary">Tests</button>
                   </div>
               </li>
           </ul>
       @endforeach
   </div>
@endsection
