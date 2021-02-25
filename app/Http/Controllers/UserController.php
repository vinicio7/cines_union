<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    protected $result       = false;
    protected $message      = 'Ocurrió un problema al procesar su solicitud';
    protected $records      = array();
    protected $status_code  = 400;
    
    public function index(Request $request)
    {
        $order = 'user_id';
        if( $request->input('order')){
            $order =  $request->input('user_id');
        }
        $length      = $request->input('length');
        $orderBy     = $order; //Index
        $orderByDir  = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        $query       = User::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data        = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
  
    public function store(Request $request)
    {
        try {
            $rules = [
                'cinema_id'            => 'required',
                'type'                 => 'required',
                'name'                 => 'required',
                'user'                 => 'required',
                'password'             => 'required',
            ];

            $messages = [
                'cinema_id.required'   => 'Es necesario que ingrese un cine',
                'type.required'        => 'Es necesario que ingrese un tipo',
                'name.required'        => 'Es necesario que ingrese un nombre',
                'user.required'        => 'Es necesario que ingrese un usuario',
                'password.required'    => 'Es necesario que ingrese una contraseña',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = User::create([
                    'cinema_id' => $request->input('cinema_id'),
                    'type'      => $request->input('type'),
                    'name'      => $request->input('name'),
                    'user'      => $request->input('user'),
                    'password'  => bcrypt($request->input('password')),
                    'status'    => 1,
                ]);
                $this->status_code  = 200;
                $this->result       = true;
                $this->message      = 'Registro creado correctamente';
                $this->records      = $data;          
            }
        } catch (Exception $e) {
            $this->status_code  = 200;
            $this->result       = false;
            $this->message      = env('APP_DEBUG') ? $e->getMessage() : $this->message;
        } finally {
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }
  
    public function show($id)
    {
        try {
            $data = User::find($id);
            $this->status_code  = 200;
            $this->result       = true;
            $this->message      = 'Registro consultado correctamente';
            $this->records      = $data;
        } catch (Exception $e) {
            $this->status_code  = 400;
            $this->result       = false;
            $this->message      = env('APP_DEBUG') ? $e->getMessage() : $this->message;
        } finally {
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $data,
            ];

            return response()->json($response, $this->status_code);
        }
    }
  
    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $data->cinema_id   = $request->input('cinema_id', $data->cinema_id);
            $data->type        = $request->input('type', $data->type);
            $data->name        = $request->input('name', $data->name);
            $data->user        = $request->input('user', $data->user);
            $data->password    = bcrypt($request->input('pasword'));
            $data->status      = $request->input('status', $data->status);
            $data->save();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registro editado correctamente';
            $this->records     = $data;
        } catch (Exception $e) {
            $this->status_code  = 400;
            $this->result       = false;
            $this->message      = env('APP_DEBUG') ? $e->getMessage() : $this->message;
        } finally {
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

    public function destroy($id)
    {
        try {
            $data = User::find($id)->delete();
            $this->status_code  = 200;
            $this->result       = true;
            $this->message      = 'Registro eliminado correctamente';
        } catch (Exception $e) {
            $this->status_code  = 400;
            $this->result       = false;
            $this->message      = env('APP_DEBUG') ? $e->getMessage() : $this->message;
        } finally {
            $response = [
                'result'  => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

}
