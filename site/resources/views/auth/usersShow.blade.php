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
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nivel de acesso</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            <td><select id = "acc_lvl_select" onchange="alterar({{json_encode($user)}})" class="browser-default custom-select" name="access_level">
                                    <option value="{{$user->access_level}}" selected>Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </td>
                        </tr>

                        <!-- todo: update()-->
                        <script>
                            function alterar(user) {
                                const ajax = new XMLHttpRequest();
                                ajax.open("POST", `/users/${user.school_id}`, true);
                                /*ajax.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {

                                    }
                                };*/
                                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                ajax.send("school_id="+user.school_id+"&name="+user.name+"&password="+user.password+"&access_level="+$('#acc_lvl_select').val()+"&_token="+"{{csrf_token()}}");
                            }
                        </script>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection


