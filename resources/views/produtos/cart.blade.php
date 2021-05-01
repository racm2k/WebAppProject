@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Product</th>
        <th style="width:10%">Price</th>
        <th style="width:8%">Quantity</th>
        <th style="width:22%" class="text-center">Subtotal</th>
        <th style="width:10%"></th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0 ?>
    @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <?php $total += $details['preco'] * $details['quantidade'] ?>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $details['nome'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{ $details['preco'] }}&euro;</td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantidade'] }}" class="form-control quantity" />
                </td>
                <td data-th="Subtotal" class="text-center">{{ $details['preco'] * $details['quantidade'] }}&euro;</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td><a href="{{ url('/produtos') }}" class="btn btn-warning" style="border-radius: 20px"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td><div class="links">
            <form action="/payment" method="POST">
                @csrf
        <script 
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_51I62h8FKwfQGokTfP5H56ImIE0JqSM0UoVdLxEEQiQLQpLOgwHGjhhFL9BlD3uu6vkYvxLHj5W1k339vos7p5vml00bsAUNMtz"
            data-amount="{{$total*100}}"
            data-name="Lidl"
            data-description="Lider"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="eur">
        </script>
        <input type="hidden" name="preco" value="{{$total}}">
    </form>
        </div></td>
        <td colspan="1" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total {{ $total }}&euro;</strong></td>
    </tr>
    </tfoot>
</table>

@endsection
