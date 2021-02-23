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
                'cinema_id'                => 'required',
                'room_id'                  => 'required',
                'movie_id'                 => 'required',
                'start_time'               => 'required',
                'end_time'                 => 'required',
                'date'                     => 'required',
                'price'                    => 'required',
            ];

            $messages = [
                'cinema_id.required'       => 'Es necesario que ingrese un cine',
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
                    'cinema_id'     => $request->input('cinema_id'),
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
            $data = Bilboard::with('room','movie','cinema')->where('bilboard_id',$id)->first();
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

    public function view_bilboard(Request $request)
    {
        try {
            if($request->input('cinema_id') && $request->input('date') && $request->input('start_time') && $request->input('end_time') && $request->input('gender') && $request->input('rating') && $request->input('format') && $request->input('language')){
                
                $data = Bilboard::where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->where('start_time', '>=', $request->input('start_time'))
                ->where('end_time', '<=', $request->input('end_time'))
                ->whereHas('movie', function ($query)use($request) {
                    return $query->where('gender', '=', $request->input('gender'))->where('rating',$request->input('rating'))->where('format',$request->input('format'))->where('language',$request->input('language'));
                })
                ->with('room','movie')
                ->get();
                
            }else if($request->input('cinema_id') && $request->input('date') && $request->input('start_time') && $request->input('end_time') && $request->input('gender') && $request->input('rating') && $request->input('format')){
                
                $data = Bilboard::where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->where('start_time', '>=', $request->input('start_time'))
                ->where('end_time', '<=', $request->input('end_time'))
                ->whereHas('movie', function ($query)use($request) {
                    return $query->where('gender', '=', $request->input('gender'))->where('rating',$request->input('rating'))->where('format',$request->input('format'));
                })
                ->with('room','movie')
                ->get();
                
            }else if($request->input('cinema_id') && $request->input('date') && $request->input('start_time') && $request->input('end_time') && $request->input('gender') && $request->input('rating')){
                
                $data = Bilboard::where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->where('start_time', '>=', $request->input('start_time'))
                ->where('end_time', '<=', $request->input('end_time'))
                ->whereHas('movie', function ($query)use($request) {
                    return $query->where('gender', '=', $request->input('gender'))->where('rating',$request->input('rating'));
                })
                ->with('room','movie')
                ->get();
                
            }
            else if($request->input('cinema_id') && $request->input('date') && $request->input('start_time') && $request->input('end_time') && $request->input('gender')){
                
                $data = Bilboard::where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->where('start_time', '>=', $request->input('start_time'))
                ->where('end_time', '<=', $request->input('end_time'))
                ->whereHas('movie', function ($query)use($request) {
                    return $query->where('gender', '=', $request->input('gender'));
                })
                ->with('room','movie')
                ->get();

            }else if($request->input('cinema_id') && $request->input('date') && $request->input('start_time') && $request->input('end_time')){
                
                $data = Bilboard::with('room','movie')
                ->where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->where('start_time', '>=', $request->input('start_time'))
                ->where('end_time', '<=', $request->input('end_time'))
                ->get();

            }else if($request->input('cinema_id') && $request->input('date')){
                
                $data = Bilboard::with('room','movie')
                ->where('cinema_id',$request->input('cinema_id'))
                ->where('date',$request->input('date'))
                ->get();

            }else if($request->input('cinema_id')){
                
                $data = Bilboard::with('room','movie')
                ->where('cinema_id',$request->input('cinema_id'))
                ->get();

            }
            $this->status_code  = 200;
            $this->result       = true;
            $this->message      = 'Registros consultados correctamente';
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
