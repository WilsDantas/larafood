@extends('adminlte::page')

@section('title', "Adicionar Novo Detalhe ao plano {$plan->name}")

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('plans.index')}}">Planos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('plans.show', $plan->url)}}">{{$plan->name}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('details.plan.index', $plan->url )}}">Detalhes do Plano {{$plan->name}}</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('details.plan.create', $plan->url )}}">Novo Detalhe {{$plan->name}}</a>
    </li>
</ol>

<h1>Adicionar Novo Detalhe ao plano {{$plan->name}}</a>
</h1>


@stop

@section('content')
<div class="card">
    <div class="card-body">
    <form action="{{route('details.plan.store', $plan->url)}}" method="post">
        @include('admin.pages.plans.details._partials.form')
    </form>
    </div>
    
</div>
@endsection