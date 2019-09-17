@extends("layouts.create")

@section('title', 'gradeClass')

@section('return', '/')

@section('add_name', 'Classe')

@include('grade_class.create')

@section('content')

   <div class="class-acess">
       <ul class="list-group">
           @foreach($gradeClasses as $class)
               <li class = "list-group-item bg-light">
                   <ul class = "list-group">
                       <li class="list-group-item font-weight-bolder text-center active">{{$class->grade_number}} {{$class->class_letter}}</li>
                       <li class="list-group-item font-weight-bolder btn-group btn-group-toggle">

                           <div class="btn-group">

                               @include('grade_class.edit')
                           </div>

                       </li>
                   </ul>
               </li>

           @endforeach
       </ul>
   </div>
@endsection
