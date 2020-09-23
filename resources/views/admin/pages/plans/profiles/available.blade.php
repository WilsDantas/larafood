@extends('adminlte::page')

@section('title', "Perfis disponiveis para o plano {$plan->name}")

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('profiles.index')}}">Profiles</a>
    </li>
</ol>

<h1>Perfis disponiveis para o plano <strong>{{$plan->name}}</strong></h1>


@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('plans.profiles.available', $plan->id)}}" method="post" class="form form-inline">
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
                <form action="{{ route('plans.profiles.attach', $plan->id)}}" method="post">
                    @csrf

                    @foreach($profiles as $profile)
                    <tr>
                        <td>
                            <input type="checkbox" name="profiles[]" value="{{$profile->id}}">
                        </td>
                        <td>{{$profile->name}}</td>
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
        {!! $profiles->appends($filters)->links() !!}
        @else
        {!! $profiles->links() !!}
        @endif
    </div>
</div>
@stop