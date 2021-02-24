<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Validator;

class AdminController extends Controller
{
    public function login(){
    	 return view('login');
    }

    public function autenticar(Request $request){
    	session()->flush();
    	$usuario = User::where('user',$request->input('user'))->first();
    	if($usuario){
    		if(\Hash::check($request->input('password'), $usuario->password)){
    			session(['success' => 'Sesion iniciada correctamente']);
    			return redirect('/home/dashboard');
    		}else{
    			session(['error' => 'Contraseña incorrecta']);
    			return \Redirect::back();
    		}
    	}else{
    		session(['error' => 'El usuario no existe']);
    		return \Redirect::back();
    	}
    	
    }
}
