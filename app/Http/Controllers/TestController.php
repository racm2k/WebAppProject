<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TestController extends Controller
{
    public function index(){
        // return "hello controller - index";
        return view("index");
    }


    public function about(){
        return view("about");
    }

    public function team(){
        return view("team");
    }

    public function controlPanel(){
        if(Auth::user()->role=="Admin"){
        $users=DB::table('users')->orderBy('role')->paginate(10);
        return view("admin", ['users'=>$users]);
    }
    else{
        return redirect('/index');
    }
    }
    
}
