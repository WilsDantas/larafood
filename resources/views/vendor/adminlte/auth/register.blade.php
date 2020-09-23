@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('Cadastrar uma nova Empresa'))

@section('auth_body')
<p><strong>Plano: </strong>{{ session('plan')->name ?? ''}}</p>
<form action="{{ route('register') }}" method="post">
    {{ csrf_field() }}

    {{-- CNPJ field --}}
    <div class="input-group mb-3">
        <input id="cnpj" type="text" name="cnpj" class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}"
            value="{{ old('cnpj') }}" placeholder="CNPJ" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @if($errors->has('cnpj'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('cnpj') }}</strong>
        </div>
        @endif
    </div>

    {{-- Empresa field --}}
    <div class="input-group mb-3">
        <input id="empresa" type="text" name="empresa"
            class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" value="{{ old('empresa') }}"
            placeholder="Empresa" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @if($errors->has('empresa'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('empresa') }}</strong>
        </div>
        @endif
    </div>



    {{-- Name field --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name') }}" placeholder="Nome Completo" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @if($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
        @endif
    </div>

    {{-- Email field --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
            value="{{ old('email') }}" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @if($errors->has('email'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </div>
        @endif
    </div>

    {{-- Password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
            placeholder="Senha">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @if($errors->has('password'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </div>
        @endif
    </div>

    {{-- Confirm password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password_confirmation"
            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
            placeholder="Repetir Senha">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @if($errors->has('password_confirmation'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </div>
        @endif
    </div>

    {{-- Register button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-user-plus"></span>
        Cadastrar
    </button>

</form>
@stop

@section('auth_footer')
<p class="my-0">
    <a href="{{ $login_url }}">
        Login
    </a>
</p>
@stop