@extends('layouts.app')

@section('title')
    {{Auth::user()->name}} - Perfil
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2> {{Auth::user()->name}}'s Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-warning mt-2" href="{{ url('/') }}"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ Auth::user()->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ Auth::user()->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Morada:</strong>
            {{ Auth::user()->morada }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Registered since:</strong>
            {{ Auth::user()->created_at }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    
    </div>

</div>
<hr>
<h2 class="text-center">Historico de Encomendas</h2>

<ul class="list-group">
    <?php $total = 0 ?>
    @forelse ($orders as $order)
    @if (Auth::user()->id==$order->user)
        <?php $total += $order->total_price ?>
    <li class="list-group-item">
        <h5>Data: {{$order->created_at}}   Total: {{ $order->total_price}}&euro;</h5>
    </li>
    
    @endif
    @empty
        <h5 class="text-center">No orders yet!</h5>
    @endforelse
    <h5 class="text-center">Total de encomendas: {{$total}}&euro;</h5>
  </ul>


@endsection