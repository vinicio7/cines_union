<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailInvoice;
use Exception;
use Validator;

class DetailInvoiceController extends Controller
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
        $query          = DetailInvoice::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
  
    public function store(Request $request)
    {
        try {
            $rules = [
                'invoice_id'                  => 'required',
                'quantity_seat'               => 'required',
                'price_seat'                  => 'required',
                'subtotal'                    => 'required',
            ];

            $messages = [
                'invoice_id.required'         => 'Es necesario que ingrese una factura',
                'quantity_seat.required'      => 'Es necesario que ingrese una cantidad',
                'price_seat.required'         => 'Es necesario que ingrese un precio',
                'subtotal.required'           => 'Es necesario que ingrese un subtotal',
              
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = DetailInvoice::create([
                    'invoice_id'    => $request->input('invoice_id'),
                    'quantity_seat' => $request->input('quantity_seat'),
                    'price_seat'    => $request->input('price_seat'),
                    'subtotal'      => $request->input('subtotal'),
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
            $data = DetailInvoice::find($id);
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
            $data = DetailInvoice::find($id);
            $data->invoice_id       = $request->input('invoice_id', $data->invoice_id);
            $data->quantity_seat    = $request->input('quantity_seat', $data->quantity_seat);
            $data->price_seat       = $request->input('price_seat', $data->price_seat);
            $data->subtotal         = $request->input('subtotal', $data->subtotal);
            $data->status           = $request->input('status', $data->status);
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
            $data = DetailInvoice::find($id)->delete();
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
