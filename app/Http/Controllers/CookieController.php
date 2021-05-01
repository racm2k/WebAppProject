<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controller\Controllers;

class CookieController extends Controller
{
    public function setCookie(Request $request){
        $minutes = 1;
        $response= new Response("hello world");
        $response->withCookie(cookie('name','ruben',$minutes));
        return $response;
    }

    public function getCookie(Request $request){
        $value = $request->cookie('name');
        echo $value;
    }
}
