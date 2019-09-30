@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu endereço de E-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um link de verificação foi enviado para seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor cheque em seu email um link de verificação.') }}
                    {{ __('Se não recebeu email.') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para enviar outro') }}</button>.
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
