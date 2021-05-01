<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;

class UserController extends Controller
{
    public function showPerfil(User $user, Orders $orders){
        $orders=Orders::paginate(5);
        return view('users.perfil',['user'=>$user,'orders'=>$orders]);
    }

    


}
