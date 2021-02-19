<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        //
        /**
         * Desplegar el listado de tipos de actividades registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $categoria = Categoria::orderBy('id', 'desc')->paginate(10);
        }else{
            $categoria = Categoria::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $categoria->total(),
                'current_page'  => $categoria->currentPage(),
                'per_page'      => $categoria->perPage(),
                'last_page'     => $categoria->lastPage(),
                'from'          => $categoria->firstItem(),
                'to'            => $categoria->lastItem(),
            ],

            'categoria' => $categoria

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $categoria = new Categoria();

            $categoria->categoria = $request->categoria;

        $categoria->save();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /**
         * Actualizar en la BD del sistema el registro seleccionado
         */

        if(!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->id);

            $categoria->categoria = $request->categoria;

        $categoria->save();

    }

    public function selectCategoria(Request $request)
    {
        /**
         * Devuelve las unidades cademicas registrados con condicion Activo
         */

        $categorias = Categoria::select('id', 'categoria')->orderBy('categoria', 'asc')->get();

        return ['categorias' => $categorias];
        
    }

}


