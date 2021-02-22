<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Exception;
use Validator;

class MovieController extends Controller
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
        $query          = Movie::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data           = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'title'               => 'required',
                'duration'            => 'required',
                'gender'              => 'required',
                'rating'              => 'required',
                'format'              => 'required',
                'image'               => 'required',
                'language'            => 'required',
            ];

            $messages = [
                'title.required'      => 'Es necesario que ingrese un titulo',
                'duration.required'   => 'Es necesario que ingrese una duracion',
                'gender.required'     => 'Es necesario que ingrese un genero',
                'rating.required'     => 'Es necesario que ingrese una clasificacion',
                'format.required'     => 'Es necesario que ingrese un formato',
                'image.required'      => 'Es necesario que ingrese una imagen',
                'language.required'   => 'Es necesario que ingrese un lenguaje',
              
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Movie::create([
                    'title'     => $request->input('title'),
                    'duration'  => $request->input('duration'),
                    'gender'    => $request->input('gender'),
                    'rating'    => $request->input('rating'),
                    'format'    => $request->input('format'),
                    'image'     => $request->input('image'),
                    'language'  => $request->input('language'),
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
            $data = Movie::find($id);
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
            $data = Movie::find($id);
            $data->title        = $request->input('title', $data->title);
            $data->duration     = $request->input('duration', $data->duration);
            $data->gender       = $request->input('gender', $data->gender);
            $data->rating       = $request->input('rating', $data->rating);
            $data->format       = $request->input('format', $data->format);
            $data->image        = $request->input('image', $data->image);
            $data->language     = $request->input('language', $data->language);
            $data->status       = $request->input('status', $data->status);
            $data->save();
            $this->status_code  = 200;
            $this->result       = true;
            $this->message      = 'Registro editado correctamente';
            $this->records      = $data;
        } catch (Exception $e) {
            $this->status_code  = 400;
            $this->result = false;
            $this->message = env('APP_DEBUG') ? $e->getMessage() : $this->message;
        } finally {
            $response = [
                'result' => $this->result,
                'message' => $this->message,
                'records' => $this->records,
            ];

            return response()->json($response, $this->status_code);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Movie::find($id)->delete();
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
