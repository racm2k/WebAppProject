@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Produtos</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-warning" style="border-radius: 20px" href="{{ url('/produtos') }}"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $produtos->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <img style="width: 150px; height: 150px" src="data:image/png;base64,{{ chunk_split(base64_encode($produtos->imagem)) }}" class="mr-3" alt="...">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Preço:</strong>
            {{ $produtos->preco }} €
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="form-group text-center">
            <p class="btn-holder"><a href="{{ url('produtos/add-to-cart',$produtos->id) }}" class="btn btn-info text-center" role="button"style="border-radius: 20px;" ><i class="fa fa-plus"></i> Add to cart</a> </p>
        </div>
    </div>

</div>
@endsection