@extends('adminlte::page')

@section('title', "Planos do Perfil {$profile->name}")

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('profiles.index')}}">Profiles</a>
    </li>
</ol>

<h1>Planos do Perfil <strong>{{$profile->name}}</strong></h1>


@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="50px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{$plan->name}}</td>
                    <td style="width=10px">
                    <a class="btn btn-danger" href="{{ route('plans.profile.detach', [$plan->id, $profile->id])}}">Desvincular</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop