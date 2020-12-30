<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class ApiCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$datos = [
            ["nombre" => "Informatica", "detalle" => "servicios de informatica"],
            ["nombre" => "electronica", "detalle" => "servicios de electronica"]
        ];*/
        $datos = Categoria::All();
        return response()->json(["categorias" => $datos], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar

        $validator = Validator::make($request->all(), [
            "nombre" => "required|unique:categorias|min:3|max:100",

        ]);

        if ($validator->fails()) {
            return response()->json(["errores" => $validator->errors()]);
        }


        //guardar
        $cat = new Categoria;
        $cat->nombre = $request->nombre;
        $cat->descripcion = $request->descripcion;
        $cat->save();

        return response()->json(["mensaje" => "La categoria se ha registrado correctamente", "status" => 201], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validar 
        $validator = Validator::make($request->all(), [
            "nombre" => "required|unique:categorias|min:3|max:100",

        ]);

        if ($validator->fails()) {
            return response()->json(["errores" => $validator->errors()]);
        }

        //modificamos
        $cat = Categoria::find($id); // busqueda por id
        $cat->nombre = $request->nombre;
        $cat->descripcion = $request->descripcion;
        $cat->save();

        return response()->json(["mensaje" => "La categoria se ha Modificado correctamente"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categoria::find($id);
        $cat->delete();
        return response()->json(["mensaje" => "La categoria se ha Eliminado correctamente"], 200);
    }
}
