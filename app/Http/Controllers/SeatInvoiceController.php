<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatInvoice;
use Exception;
use Validator;

class SeatInvoiceController extends Controller
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
        $query          = SeatInvoice::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'client_id'             => 'required',
                'seat_id'               => 'required',
                'invoice_id'            => 'required',
                'bilboard_id'           => 'required',
            ];

            $messages = [
                'client_id.required'    => 'Es necesario que ingrese un cliente',
                'seat_id.required'      => 'Es necesario que ingrese un asiento',
                'invoice_id.required'   => 'Es necesario que ingrese una factura',
                'bilboard_id.required'  => 'Es necesario que ingrese una cartelera',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = SeatInvoice::create([
                    'client_id'     => $request->input('client_id'),
                    'seat_id'       => $request->input('seat_id'),
                    'invoice_id'    => $request->input('invoice_id'),
                    'bilboard_id'   => $request->input('bilboard_id'),
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
                'result'   => $this->result,
                'message'  => $this->message,
                'records'  => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

    public function show($id)
    {
        try {
            $data = SeatInvoice::find($id);
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
            $data = SeatInvoice::find($id);
            $data->client_id        = $request->input('client_id', $data->client_id);
            $data->seat_id          = $request->input('seat_id', $data->seat_id);
            $data->invoice_id       = $request->input('invoice_id', $data->invoice_id);
            $data->bilboard_id      = $request->input('bilboard_id', $data->bilboard_id);
            $data->save();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registro editado correctamente';
            $this->records     = $data;
        } catch (Exception $e) {
            $this->status_code = 400;
            $this->result = false;
            $this->message = env('APP_DEBUG') ? $e->getMessage() : $this->message;
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
            $data = SeatInvoice::find($id)->delete();
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
