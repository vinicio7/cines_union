<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;
use Exception;
use Validator;

class CinemaController extends Controller
{
    protected $result       = false;
    protected $message      = 'Ocurrió un problema al procesar su solicitud';
    protected $records      = array();
    protected $status_code  = 400;
    
    public function index(Request $request)
    {
        $length      = $request->input('length');
        $orderBy     = $request->input('column'); //Index
        $orderByDir  = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        $query       = Cinema::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data        = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name'                      => 'required',
                'logo'                      => 'required',
                'latitude'                  => 'required',
                'longitude'                 => 'required',
                'departament_id'            => 'required',
                'municipality_id'           => 'required',
            ];

            $messages = [
                'name.required'             => 'Es necesario que ingrese un nombre',
                'logo.required'             => 'Es necesario que ingrese un logo',
                'latitude.required'         => 'Es necesario que ingrese una latitud',
                'longitude.required'        => 'Es necesario que ingrese una longitud',
                'departament_id.required'   => 'Es necesario que ingrese un departamento',
                'municipality_id.required'  => 'Es necesario que ingrese un municipalidad',
              
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            } else {
                $data = Cinema::create([
                    'name'            => $request->input('name'),
                    'logo'            => $request->input('logo'),
                    'latitude'        => $request->input('latitude'),
                    'longitude'       => $request->input('longitude'),
                    'departament_id'  => $request->input('departament_id'),
                    'municipality_id' => $request->input('municipality_id'),
                    'status'          => 1,
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
            $data = Cinema::with('departament','municipality')->where('cinema_id',$id)->first();
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
            $data = Cinema::find($id);
            $data->name             = $request->input('name', $data->name);
            $data->logo             = $request->input('logo', $data->logo);
            $data->latitude         = $request->input('latitude', $data->latitude);
            $data->longitude        = $request->input('longitude', $data->longitude);
            $data->departament_id   = $request->input('departament_id', $data->departament_id);
            $data->municipality_id  = $request->input('municipality_id', $data->municipality_id);
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
            $data = Cinema::where('cinema_id',$id)->delete();
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