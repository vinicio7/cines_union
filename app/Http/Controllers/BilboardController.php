<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilboard;
use Exception;
use Validator;

class BilboardController extends Controller
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
        $query          = Bilboard::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }
  
    public function store(Request $request)
    {
        try {
            $rules = [
                'room_id'                  => 'required',
                'movie_id'                 => 'required',
                'start_time'               => 'required',
                'end_time'                 => 'required',
                'date'                     => 'required',
                'price'                    => 'required',
            ];

            $messages = [
                'room_id.required'         => 'Es necesario que ingrese una sala',
                'movie_id.required'        => 'Es necesario que ingrese una pelicula',
                'start_time.required'      => 'Es necesario que ingrese una hora de inicio',
                'end_time.required'        => 'Es necesario que ingrese una hora de finalizacion',
                'date.required'            => 'Es necesario que ingrese una fecha',
                'price.required'           => 'Es necesario que ingrese un precio',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Bilboard::create([
                    'room_id'       => $request->input('room_id'),
                    'movie_id'      => $request->input('movie_id'),
                    'start_time'    => $request->input('start_time'),
                    'end_time'      => $request->input('end_time'),
                    'date'          => $request->input('date'),
                    'price'         => $request->input('price'),
                    'status'        => 1,
                ]);
                $this->status_code = 200;
                $this->result      = true;
                $this->message     = 'Registro creado correctamente';
                $this->records     = $data;
            }
        } catch (Exception $e) {
            $this->status_code = 200;
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
  
    public function show($id)
    {
        try {
            $data = Bilboard::with('room','movie')->where('bilboard_id',$id)->first();
            $this->status_code  = 200;
            $this->result       = true;
            $this->message      = 'Registro consultado correctamente';
            $this->records      = $data;
        } catch (Exception $e) {
            $this->status_code = 400;
            $this->result      = false;
            $this->message     = env('APP_DEBUG') ? $e->getMessage() : $this->message;
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
            $data = Bilboard::where('bilboard_id',$id)->first();
            $data->room_id           = $request->input('room_id', $data->room_id);
            $data->movie_id          = $request->input('movie_id', $data->movie_id);
            $data->start_time        = $request->input('start_time', $data->start_time);
            $data->end_time          = $request->input('end_time', $data->end_time);
            $data->date              = $request->input('date', $data->date);
            $data->price             = $request->input('price', $data->price);
            $data->status            = $request->input('status', $data->status);
            $data->save();
            $this->status_code = 200;
            $this->result      = true;
            $this->message     = 'Registro editado correctamente';
            $this->records     = $data;
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

    public function destroy($id)
    {
        try {
            $data = Bilboard::where('bilboard_id',$id)->delete();
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
