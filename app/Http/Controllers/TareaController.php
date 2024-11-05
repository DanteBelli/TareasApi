<?php

namespace App\Http\Controllers;

use App\Models\tarea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Cargo todas las tareas
        $tareas = tarea::all();
        if($tareas->isEmpty()){
            $error =[
                'message'=>'No existen tareas',
                'status'=>200,
            ];
            return response()->json($error,404);
        }
        return response()->json($tareas,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Guardo una tarea nueva
       $validate =  Validator::make($request->all(),[
            'nombre'=>'required',
            'descripcion'=>'required',
        ]);
        if ($validate->fails()){
            return response()->json([
                'message'=>'Error , verifique los datos',
                'error'=>$validate->errors(),
                'status'=>400
            ],400);
        }
        $tarea = tarea::create([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
        ]);
        if(!$tarea){
            $respuesta=[
                'message'=>'Error al generar tarea',
                'status' =>500,
            ];
            return response()->json($respuesta,500);
        }
        return response()->json([
            'tarea' => $tarea,
            'status'=> 201
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //muestro una tarea en especial
        $tarea= tarea::find($id);
        if(!$tarea){
            $data = [
                'message'=>'No existe esta tarea',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $data =[
            'tarea'=>$tarea,
            'status'=>200
        ];
        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request , $id)
    {
        //
        $tarea = tarea::find($id);
        if(!$tarea){
            $data = [
                'message' => 'Tarea no Encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $valid = Validator::make($request->all(),[
            'nombre' =>'max:255',
            'descripcion'=>'max:250'
        ]);
        if($valid->fails()){
            $data = [
                'message'=>'Error en la validacion',
                'errors'=>$valid->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        if($request->has('nombre')){
            $tarea->nombre = $request->nombre;
        }else{
            $tarea->descripcion = $request->descripcion;
        }
        $tarea->save();
        $data = [
            'message'=>'Tarea actualizada',
            'tarea'=>$tarea,
            'status'=>200
        ];
        return response()->json($data,200);
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $tarea = tarea::find($id);
        if(!$tarea){
            $data = [
                'message' => 'Tarea no Encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $validacion = Validator::make($request->all(),[
            'nombre'=>'required',
            "descripcion"=>'required'
        ]);
        if($validacion->fails()){
            $data = [
                'message'=>'Error validando los datos',
                'error'=>$validacion->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->save();
        $data = [
            'message'=>'Actualizado con exito',
            'tareas'=>$tarea,
            'status'=>200
        ];
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //elimino tarea
        $tareas = tarea::find($id);
        if(!$tareas){
            $data = [
                'message' => 'Tarea no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $tareas->delete();
        $data = [
            'message' => 'Tarea eliminada con Exito',
            'status' =>200
        ];
        return response()->json($data,200);
    }
}
