@extends('layouts.app')
@section('content')
<form action="{{url('/produtos')}}" method="post" class="container" enctype="multipart/form-data">
    @csrf {{-- <- Required for protection or the form is rejected --}}
    <div class="form-group">
        <label for="nome">Nome</label>
     <input id="nome" type="text" class="form-control" name="nome" value="{{old('nome')}}">
</div>
<div class="form-group">
  <label for="preco">Preço</label>
  <input type="text" name="preco" id="preco" class="form-control" placeholder="0.00€" aria-describedby="helpId">
  </div>
  <div class="form-group">
    <label for="codigo">Codigo</label>
    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="" aria-describedby="helpId">
    
  </div>
  <div class="form-group">
    <label for="categoria">Categoria</label>
    <select class="form-control" name="categoria" id="exampleFormControlSelect2">
        <option>...</option>
        <option>Criança</option>
        <option>Bebidas</option>
        <option>Comida</option>
        <option>Eletrodomésticos</option>
        <option>Higiene</option>
        <option>Vestuario/Calcado</option>
      </select>
    </div>
    <div class="form-group">
      <label for="quantidade">Quantidade</label>
      <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="" aria-describedby="helpId">
      </div>
      <div class="form-group">
        <label for="imagem">File input</label>
        <input type="file" name="imagem" class="form-control-file" id="imagem">
      </div>
<button type="submit" class="btn btn-primary">Create</button>
</form>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection

