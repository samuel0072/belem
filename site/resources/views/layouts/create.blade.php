@extends('layouts.layout')

@section('head-content')
    <div class="w3-container">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-teal ">Adicionar @yield('add_name')</button>

        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    @yield('hidden_content')
                </div>
            </div>
        </div>
    </div>
@endsection



