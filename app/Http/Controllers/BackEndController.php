<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BackEndController extends Controller
{
    public function getNews(){
        $noticias = DB::table('posts')->orderBy('id', 'desc')->get();
        return response()->json($noticias);
    }

    public function getTendencia(){
        $noticias = DB::table('posts')->limit(3)->orderBy('visitas', 'desc')->get();
        return response()->json($noticias);
    }

    public function getLeftNews(){
        $noticias = DB::table('posts')->skip(3)->take(3)->orderBy('id', 'desc')->get();
        return response()->json($noticias);
    }

    public function getNoticia(Request $request){
        $id = $request->input('id');
        $noticias = DB::table('posts')->where('id', '=', $id)->get();
        return response()->json($noticias);
    }
}
