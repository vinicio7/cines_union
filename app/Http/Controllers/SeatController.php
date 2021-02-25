<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use Exception;
use Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class SeatController extends Controller
{
    protected $result      = false;
    protected $message     = 'Ocurrió un problema al procesar su solicitud';
    protected $records     = array();
    protected $status_code = 400;
    
    public function index(Request $request)
    {
        $order = 'seat_id';
        if( $request->input('order')){
            $order =  $request->input('seat_id');
        }
        $length      = $request->input('length');
        $orderBy     = $order; //Index
        $orderByDir  = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        $query       = Seat::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data        = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
 
    public function store(Request $request)
    {
        try {
            $rules = [
                'room_id'              => 'required',
                'seat_number'          => 'required',
            ];

            $messages = [
                'room_id.required'     => 'Es necesario que ingrese una sala',
                'seat_number.required' => 'Es necesario que ingrese un numero de asiento',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Seat::create([
                    'room_id'       => $request->input('room_id'),
                    'seat_number'   => $request->input('seat_number'),
                    'status'        => 1,
                ]);
                $this->status_code = 200;
                $this->result      = true;
                $this->message     = 'Registro creado correctamente';
                $this->records     = $data;  
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
            $data = Seat::find($id);
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
            $data = Seat::find($id);
            $data->room_id         = $request->input('room_id', $data->room_id);
            $data->seat_number     = $request->input('seat_number', $data->seat_number);
            $data->status          = $request->input('status', $data->status);
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
            $data = Seat::find($id)->delete();
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
