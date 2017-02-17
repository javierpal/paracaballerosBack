<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;

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

    public function Autenticate(Request $request){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');

        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );
        
        $validator = $this->validator($credentials);
        $fails = $validator->fails();
        if($fails){
            return response()->json($validator->errors()->all());
        }else{
            $logincred = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($logincred)) {
                    return response()->json(['Correo o Contraseña Invalidos']);
                }
            } catch (JWTException $e) {
                return response()->json(['Ocurrio un Error Intentalo mas tarde']);
            }
            return response()->json(compact('token'));
        }
    }

    public function validator(array $data)
    {
            return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);
    }

    public function findAdmin(){
        $user = $this->getAuthenticatedUser();
        
        $userok = $user->getData();
        
        $userbican = User::find($userok->user->id);
        $token = JWTAuth::getToken();
        
        $headers = array(
            'Autorization' => "Bearer ".$token,
        );
            
        $parameters = array(
            'token' => $token,
        );
        
        if($userbican->level() == 100){
            return response()->json("admin");
        }else{
            return response()->json("no");;
        }
    }

    public function getAuthenticatedUser()
    {
        try {
    
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
    
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    
            return response()->json(['token_expired'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
            return response()->json(['token_invalid'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
    
            return response()->json(['token_absent'], $e->getStatusCode());
    
        }
    
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
    
}
