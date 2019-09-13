@extends("layouts.create")

@section('title', 'gradeClass')

@section('add_name', 'Classe')


{{--<a href="/grade_class/create" class = "btn btn-teal">Adicionar</a>--}}

@section('hidden_content')
    <div>
        <form method="post" action="/grade_class">
            {{csrf_field()}}
            <div>
                <label for="school_id">ID da escola</label>
                <input class = "form-control" type = "number" placeholder="Nº da Escola" required name ="school_id">
            </div>

            <div>
                <label for="class_letter">Turma</label>
                <input class = "form-control" placeholder="Class Letter" required name ="class_letter">

            </div>

            <div>
                <label for="grade_number">Numero da classe</label>
                <input class = "form-control" type = "number" placeholder="Ano da classe" required name ="grade_number">
            </div>

            <div>
                <button class="btn btn-primary" type = "submit">Criar Classe</button>
            </div>
        </form>
    </div>
@endsection

@section('content')

   <div class="class-acess">
       <ul class="list-group">
           @foreach($gradeClasses as $class)
               <li class = "list-group-item bg-light">
                   <ul class = "list-group">
                       <li class="list-group-item font-weight-bolder text-center active">{{$class->grade_number}} {{$class->class_letter}}</li>
                       <li class="list-group-item font-weight-bolder btn-group btn-group-toggle">

                           <div class="btn-group">
                               <a class="btn btn-primary" href="/grade_class/{{$class->id}}/students">Alunos</a>
                               <a class="btn btn-secondary" href="/grade_class/{{$class->id}}/tests">Testes</a>
                               @include('grade_class.edit')
                           </div>

                       </li>
                   </ul>
               </li>

           @endforeach
       </ul>
   </div>
@endsection
