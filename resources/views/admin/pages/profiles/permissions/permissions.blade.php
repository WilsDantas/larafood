@extends('adminlte::page')

@section('title', "Permissões do Perfil {$profile->name}")

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('profiles.index')}}">Profiles</a>
    </li>
</ol>

<h1>Permissões do Perfil <strong>{{$profile->name}}</strong> <a href="{{route('profile.permissions.available', $profile->id)}}" class="btn btn-dark"><i class="fas fa-plus-square"> Adicionar Nova Permissão</i></a>
</h1>


@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="50">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>
                        <a href="{{ route('profile.permissions.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop