<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cinema;
use App\Models\CinemaRoom;
use App\Models\Invoice;
use App\Models\Movie;
use App\Models\SeatInvoice;
use App\Models\Bilboard;
use App\Models\DetailInvoice;
use Exception;
use Validator;

class AdminController extends Controller
{
    public function login(){
        if(session()->get('user')){
            return redirect('/home');
        }else{
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
    }

    public function cinemas(Request $request){
        if(session()->get('user')){
            return view('cinemas');
        }else{
            return view('login');
        }
    }

    public function cinemas_room(Request $request){
        if(session()->get('user')){
            return view('cinemas_room');
        }else{
            return view('login');
        }
    }

    public function seats(Request $request){
        if(session()->get('user')){
            return view('seats');
        }else{
            return view('login');
        }
    }

    public function users(Request $request){
        if(session()->get('user')){
            return view('users');
        }else{
            return view('login');
        }
    }

    public function home(Request $request){
        $list_users          = User::where('status',1)->OrderBy('created_at','DESC')->get()->take(5);
        $list_movies         = Movie::where('status',1)->OrderBy('created_at','DESC')->get()->take(5);
        $list_cinemas        = Cinema::where('status',1)->OrderBy('created_at','DESC')->get()->take(5);
        $list_sell           = SeatInvoice::OrderBy('created_at','DESC')->get()->take(5);
        foreach ($list_sell as $sell) {
            $count           = 0;
            $bilboard        = Bilboard::where('bilboard_id',$sell->bilboard_id)->first();
            if($bilboard){
                $movie       = Movie::where('movie_id',$bilboard->movie_id)->first();
                $sell->movie = $movie->title;
            }else{
                $sell->movie = '';
            }
            $detail  = DetailInvoice::where('invoice_id',$sell->invoice_id)->get();
            foreach ($detail as $item) {
                $count = $count + $item->quantity_seat;
            }
            $sell->seats = $count;
        }
        foreach ($list_cinemas as $cinema) {
            $cinema_room        = CinemaRoom::where('status',1)->where('cinema_id',$cinema->cinema_id)->count();
            $cinema->count_room = $cinema_room;
        }
        $total_cinema   = Cinema::where('status',1)->count();
        $total_room     = CinemaRoom::where('status',1)->count();
        $total_movie    = Movie::where('status',1)->count();
        $total_invoice  = Invoice::where('status',1)->count();
    	session(['total_cinema'  => $total_cinema]);
        session(['total_room'    => $total_room]);
        session(['total_movie'   => $total_movie]);
        session(['total_invoice' => $total_invoice]);
    	return view('home',['list_users' => $list_users,'list_cinemas'=>$list_cinemas,'list_movies'=>$list_movies,'list_sell'=>$list_sell]);
    }

}
