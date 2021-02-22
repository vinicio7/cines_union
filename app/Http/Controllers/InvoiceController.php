<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Exception;
use Validator;

class InvoiceController extends Controller
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
        $query          = Invoice::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
 
    public function store(Request $request)
    {
        try {
            $rules = [
                'client_id'               => 'required',
                'bilboard_id'             => 'required',
                'user_id'                 => 'required',
                'date'                    => 'required',
                'total'                   => 'required',
            ];

            $messages = [
                'client_id.required'      => 'Es necesario que ingrese un cliente',
                'bilboard_id.required'    => 'Es necesario que ingrese una cartelera',
                'user_id.required'        => 'Es necesario que ingrese un usuario',
                'date.required'           => 'Es necesario que ingrese una fecha',
                'total.required'          => 'Es necesario que ingrese un total',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Invoice::create([
                    'client_id'     => $request->input('client_id'),
                    'bilboard_id'   => $request->input('bilboard_id'),
                    'user_id'       => $request->input('user_id'),
                    'date'          => $request->input('date'),
                    'total'         => $request->input('total'),
                    'status'        => 1,
                ]);
                $this->status_code = 200;
                $this->result  = true;
                $this->message = 'Registro creado correctamente';
                $this->records = $data;      
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
            $data = Invoice::find($id);
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
            $data = Invoice::find($id);
            $data->client_id           = $request->input('client_id', $data->client_id);
            $data->bilboard_id         = $request->input('bilboard_id', $data->bilboard_id);
            $data->user_id             = $request->input('user_id', $data->user_id);
            $data->date                = $request->input('date', $data->date);
            $data->total               = $request->input('total', $data->total);
            $data->status              = $request->input('status', $data->status);
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
            $data = Invoice::find($id)->delete();
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
