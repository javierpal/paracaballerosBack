<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BackEndController extends Controller
{
    public function getNews(){
        $noticias = DB::table('posts')->get();
        return response()->json($noticias);
    }
}
