<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubActividad;


class SubActividadController extends Controller
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
            $subactividades = SubActividad::orderBy('id', 'desc')->paginate(10);
        }else{
            $subactividades = SubActividad::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $subactividades->total(),
                'current_page'  => $subactividades->currentPage(),
                'per_page'      => $subactividades->perPage(),
                'last_page'     => $subactividades->lastPage(),
                'from'          => $subactividades->firstItem(),
                'to'            => $subactividades->lastItem(),
            ],

            'subactividades' => $subactividades

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $subactividades = new SubActividad();

            $subactividades->descripcion = $request->descripcion;

        $subactividades->save();

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

        $subactividades = SubActividad::findOrFail($request->id);

            $subactividades->descripcion = $request->descripcion;

        $subactividades->save();

    }
}
