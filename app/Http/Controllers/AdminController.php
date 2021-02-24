<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Validator;

class AdminController extends Controller
{
    public function login(){
        if(session()->get('user')){
            return redirect('/home');
        }else{
            session()->flush();
            return view('login');
        }
    }

    public function index(){
            session()->flush();
            return redirect('/');
    }

    public function logout(){
            session()->flush();
            return redirect('login');
    }

    public function autenticar(Request $request){
        try {
            session()->flush();
            $usuario = User::where('user',$request->input('user'))->first();
            if($usuario){
                if(\Hash::check($request->input('password'), $usuario->password)){
                    session(['success' => 'Sesion iniciada correctamente']);
                    session(['user' => $usuario]);
                    return redirect('/home');
                }else{
                    session(['error' => 'Contraseña incorrecta']);
                    return \Redirect::back();
                }
            }else{
                session(['error' => 'El usuario no existe']);
                return \Redirect::back();
            }
        } catch (\Exception $e) {
            return $e;              
        }
    }

    public function home(Request $request){
    	//session()->flush();
    	return view('home');
    }

}
