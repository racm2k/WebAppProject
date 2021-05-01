<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Http\Controllers\OrdersController;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderReceipt;


class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        $produtos = Produtos::paginate(5);
        return view('produtos.main',['produtos'=>$produtos]);
    }

    public function indexComida()
    {
        $produtos = DB::table('produtos')->where('categoria', "Comida")->paginate(5);
        
        return view('produtos.comida',['produtos'=>$produtos]);
    }

    public function indexCrianca()
    {
        $produtos = DB::table('produtos')->where('categoria', "Crianca")->paginate(5);
        
        return view('produtos.crianca',['produtos'=>$produtos]);
    }

    public function indexVestuarioCalcado()
    {
        $produtos = DB::table('produtos')->where('categoria', "Vestuario/Calcado")->paginate(5);
        
        return view('produtos.vestuario-calcado',['produtos'=>$produtos]);
    }

    public function indexHigiene()
    {
        $produtos = DB::table('produtos')->where('categoria', "Higiene")->paginate(5);
        
        return view('produtos.higiene',['produtos'=>$produtos]);
    }

    public function indexBebidas()
    {
        $produtos = DB::table('produtos')->where('categoria', "Bebidas")->paginate(5);
        
        return view('produtos.bebidas',['produtos'=>$produtos]);
    }

    public function indexEletrodomesticos()
    {
        $produtos = DB::table('produtos')->where('categoria', "Eletrodomesticos")->paginate(5);
        
        return view('produtos.eletrodomesticos',['produtos'=>$produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()){
            return redirect('/');
        }
        elseif(Auth::user()->role =="Admin"){
            return view('produtos.create');
        }
            else{
                return redirect('/');
            }
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required','string'],
            'preco' => ['required','numeric','between:0,10000.00'],
            'codigo' => ['required','string'],
            'categoria' => ['required','string'],
            'quantidade' => ['required','numeric','min:1'],
        ]);


        $produto=new Produtos();
        $produto->nome=$request->nome;
        $produto->preco=$request->preco;
        $produto->codigo=$request->codigo;
        $produto->categoria=$request->categoria;
        $produto->quantidade=$request->quantidade;
        $produto->imagem=file_get_contents($request->imagem);

        $produto->save();
    
        return redirect('/produtos')->with('success', 'Product created successfully.'); 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show(Produtos $produtos)
    {
        return view('produtos.show', ['produtos' => $produtos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produtos)
    {
        return view('produtos.edit', ['produtos' => $produtos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produtos $produtos)
    {
        
        $request->validate([
            'nome' => ['required','string'],
            'preco' => ['required','numeric','min:0'],
            'codigo' => ['required','string'],
            'categoria' => ['required','string'],
            'quantidade' => ['required','numeric','min:0'],
        ]);

        $produtos->update($request->all());

        return redirect('/produtos');
    }

    public function cart(Produtos $produtos)
    {
        return view('produtos.cart', ['produtos' => $produtos]);
    }

    public function addToCart($id)
    {
        if(!Auth::user()){
            return redirect('login');

        }else{

        $product = Produtos::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "nome" => $product->nome,
                        "quantidade" => 1,
                        "preco" => $product->preco,
                        
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantidade']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "nome" => $product->nome,
            "quantidade" => 1,
            "preco" => $product->preco,
            
        ];
        session()->put('cart', $cart);

       // Cookie::queue('carrinho',json_encode(session()->get('cart')));
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produtos)
    {
        $produtos->delete();

        return redirect('/produtos');
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function search(Request $request){
        $q = $request->get('q') ;
        $produtos = Produtos::where ( 'nome', 'LIKE', '%' . $q . '%' )->orWhere ('categoria','LIKE','%' . $q . '%')->paginate(5);
    
        return view ( 'produtos.search', ['produtos'=>$produtos] );
    }

    public function paymentProcess(Request $request, Orders $order){
        
        \Stripe\Stripe::setApiKey("sk_test_51I62h8FKwfQGokTfmxqR22nzOBqcgBZEO12jm1xFPTy28CQNswxpVcKRM07Cb2uAry3uaE6XE3yZYd134w9rMy4O00Hlrx0W4I");
        $token= $_POST['stripeToken'];
        $charge= \Stripe\Charge::create([
            'amount' =>$request->preco*100,
            'currency'=> 'eur',
            'description'=>'Example charge',
            'source'=>$token,
        ]);
        Mail::to(Auth::user()->email)->send(new OrderReceipt());
        $order=new Orders();
        $order->user=Auth::user()->id;
        $order->total_price=$request->preco;
        $order->save();

        $request->session()->forget('cart');

return redirect('/produtos/cart')->with('success','Obrigado pela compra');
    }
}
