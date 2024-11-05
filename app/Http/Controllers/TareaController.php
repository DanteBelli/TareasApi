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
    public function edit(tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tarea $tarea)
    {
        //elimino tarea
    }
}
