<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Exception;
use Validator;

class ClientController extends Controller
{
    protected $result       = false;
    protected $message      = 'Ocurrió un problema al procesar su solicitud';
    protected $records      = array();
    protected $status_code  = 400;
    
    public function index(Request $request)
    {
        $length         = $request->input('length');
        $orderBy        = $request->input('column'); //Index
        $orderByDir     = $request->input('dir', 'asc');
        $searchValue    = $request->input('search');
        $query          = Client::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
  
    public function store(Request $request)
    {
        try {
            $rules = [
                'name'               => 'required',
                'direction'          => 'required',
                'phone'              => 'required',
            ];

            $messages = [
                'name.required'      => 'Es necesario que ingrese un nombre',
                'direction.required' => 'Es necesario que ingrese una direccion',
                'phone.required'     => 'Es necesario que ingrese un numero telefono',
              
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Client::create([
                    'name'          => $request->input('name'),
                    'direction'     => $request->input('direction'),
                    'phone'         => $request->input('phone'),
                    'name_tax'      => $name_tax,
                    'tax'           => $tax,
                    'status'        => 1,
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
            $data = Client::find($id);
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
            $data = Client::find($id);
            $data->name           = $request->input('name', $data->name);
            $data->direction      = $request->input('direction', $data->direction);
            $data->phone          = $request->input('phone', $data->phone);
            $data->name_tax       = $request->input('name_tax', $data->name_tax);
            $data->tax            = $request->input('tax', $data->tax);
            $data->status         = $request->input('status', $data->status);
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
            $data = Client::find($id)->delete();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registro eliminado correctamente';
        } catch (Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG') ? $e->getMessage() : $this->message;
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
