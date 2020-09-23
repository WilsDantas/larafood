@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{route('products.index')}}">Produtos</a>
    </li>
</ol>

<h1>Produtos
    @can('add_cat')
        <a href="{{route('products.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"> Adicionar</i></a>
    @endcan
</h1>


@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('products.search')}}" method="post" class="form form-inline">
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
                    <th style="max-width: 90px;">Imagem</th>
                    <th>Titulo</th>
                    <th>Preço</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                <td><img src="{{ asset("storage/{$product->image}")}}" alt="{{$product->title}}" style="max-width: 90px;"></td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{ route('products.categories', $product->id)}}" class="btn btn-info" title="Categorias"><i class="fas fa-layer-group"></i></a>
                        <a href="{{ route('products.edit', $product->id)}}" class="btn btn-info">Editar</a>
                        <a href="{{ route('products.show', $product->id)}}" class="btn btn-warning">Ver</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $products->appends($filters)->links() !!}
        @else
        {!! $products->links() !!}
        @endif
    </div>
</div>
@stop