@extends('adminlte::page')

@section('title', "Perfis da Permissão {$permission->name}")

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('profiles.index')}}">Profiles</a>
    </li>
</ol>

<h1>Perfis da Permissão <strong>{{$permission->name}}</strong></h1>


@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profiles as $profile)
                <tr>
                    <td>{{$profile->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop