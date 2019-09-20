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

                            <td><select onchange="alterar({{$user->id}}, {{auth()->user()->access_level}})" class="browser-default custom-select" name="access_level">
                                    <option value="{{$user->access_level}}" selected>Select</option>
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </td>
                        </tr>

                        <script>
                            function alterar(id, access_level) {
                                if(access_level > 2)
                                    console.log(id);
                            }
                        </script>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection


