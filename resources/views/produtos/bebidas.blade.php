@extends('layouts.app')

@section('title')
Bebidas  
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<ul class="list-group">
    @forelse($produtos as $produto)
    
      <li class="list-group-item">
          <div class="media">
            <a href="{{ url('produtos/show',$produto->id) }}">
            <img style="width: 150px; height: 150px" src="data:image/png;base64,{{ chunk_split(base64_encode($produto->imagem)) }}" class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0 text-success text-decoration-none"><strong>{{$produto->nome}}</strong></h5>  </a>
              <p class="card-text text-secondary">{{$produto->categoria}}</p>
              <p class="card-text text-dark"><strong>{{$produto->preco}}€</strong></p>
              <p class="btn-holder"><a href="{{ url('produtos/add-to-cart',$produto->id) }}" class="btn btn-info text-center" style="border-radius: 20px;" role="button"><i class="fa fa-plus"></i> Add to cart</a> </p>
            </div>
          </div>
        @guest
              
        @else
            @if (Auth::user()->role == 'Admin')
                <form action="{{ url('produtos/destroy',$produto->id) }}" method="POST" >
                 <a class="btn btn-info"style="border-radius: 20px" href="{{ url('produtos/show',$produto->id) }}">Show</a>
                 <a class="btn btn-primary"style="border-radius: 20px" href="{{ url('produtos/edit',$produto->id) }}">Edit</a>
                  @csrf
                  <button type="submit"style="border-radius: 20px" class="btn btn-danger">Delete</button>
                </form>
            @endif
        
        
        @endguest
    </li>
    
    @empty
    <h5 class="text-center">No produtos Found!</h5>
    @endforelse
  </ul>
{!! $produtos->links('pagination::bootstrap-4') !!}
@endsection