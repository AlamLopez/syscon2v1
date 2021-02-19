<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContratos;

class TipoContratosController extends Controller
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
            $tipocontratos = TipoContratos::orderBy('id', 'desc')->paginate(10);
        }else{
            $tipocontratos = TipoContratos::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $tipocontratos->total(),
                'current_page'  => $tipocontratos->currentPage(),
                'per_page'      => $tipocontratos->perPage(),
                'last_page'     => $tipocontratos->lastPage(),
                'from'          => $tipocontratos->firstItem(),
                'to'            => $tipocontratos->lastItem(),
            ],

            'tipocontratos' => $tipocontratos

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $tipocontratos = new TipoContratos();

            $tipocontratos->descripcion = $request->descripcion;

        $tipocontratos->save();

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

        $tipocontratos = TipoContratos::findOrFail($request->id);

            $tipocontratos->descripcion = $request->descripcion;

        $tipocontratos->save();

    }
}

