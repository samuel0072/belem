@extends('layouts.layout')

@section('title', 'Users')

@section('content')

    <div class='card'>
        <div class="card-header">
            <h1>Usuários</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>@include('auth.show', compact('user'))</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        function alterar(user) {
            const ajax = new XMLHttpRequest();
            ajax.open("POST", `/school/${user.school_id}/users/`, true);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("id="+user.id+"&school_id="+user.school_id+"&name="+user.name+"&password="+user.password+"&access_level="+$('#acc_lvl_select').val()+"&_token="+"{{csrf_token()}}");
        }
    </script>
@endsection


