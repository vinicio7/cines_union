<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CinemaRoom;
use Exception;
use Validator;

class CinemaRoomController extends Controller
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
        $query          = CinemaRoom::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'cinema_id'             => 'required',
                'seat'                  => 'required',
                'name_room'             => 'required'
            ];

            $messages = [
                'cinema_id.required'    => 'Es necesario que ingrese un cine',
                'seat.required'         => 'Es necesario que ingrese una cantidad de asientos',
                'name_room.required'    => 'Es necesario que ingrese un nombre de la sala',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = CinemaRoom::create([
                    'cinema_id' => $request->input('cinema_id'),
                    'seat'      => $request->input('seat'),
                    'name_room' => $request->input('name_room'),
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
            $data = CinemaRoom::with('cinema')->find($id);
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
            $data = CinemaRoom::find($id);
            $data->cinema_id     = $request->input('cinema_id', $data->cinema_id);
            $data->seat          = $request->input('seat', $data->seat);
            $data->name_room     = $request->input('name_room', $data->name_room);
            $data->status        = $request->input('status', $data->status);
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
            $data = CinemaRoom::find($id)->delete();
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
