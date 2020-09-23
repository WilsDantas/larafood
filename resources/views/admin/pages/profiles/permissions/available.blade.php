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

<h1>Permissões disponiveis para o perfil <strong>{{$profile->name}}</strong></h1>


@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profile.permissions.available', $profile->id)}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Pesquisar..." class="form-control"
                value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th width="50px">#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('profile.permissions.attach', $profile->id)}}" method="post">
                    @csrf

                    @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                        </td>
                        <td>{{$permission->name}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $permissions->appends($filters)->links() !!}
        @else
        {!! $permissions->links() !!}
        @endif
    </div>
</div>
@stop