<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividad;

class TipoActividadController extends Controller
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
            $tipoactividades = TipoActividad::orderBy('id', 'desc')->paginate(10);
        }else{
            $tipoactividades = TipoActividad::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $tipoactividades->total(),
                'current_page'  => $tipoactividades->currentPage(),
                'per_page'      => $tipoactividades->perPage(),
                'last_page'     => $tipoactividades->lastPage(),
                'from'          => $tipoactividades->firstItem(),
                'to'            => $tipoactividades->lastItem(),
            ],

            'tipoactividades' => $tipoactividades

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $tipoactividad = new TipoActividad();

            $tipoactividad->descripcion = $request->descripcion;
            $tipoactividad->esdocente = $request->esdocente;
            $tipoactividad->espermanente = $request->espermanente;            
            $tipoactividad->esadministrativo = $request->esadministrativo;
            $tipoactividad->estecnico = $request->estecnico;

        $tipoactividad->save();

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

        $tipoactividad = TipoActividad::findOrFail($request->id);

            $tipoactividad->descripcion = $request->descripcion;
            $tipoactividad->esdocente = $request->esdocente;
            $tipoactividad->espermanente = $request->espermanente;            
            $tipoactividad->esadministrativo = $request->esadministrativo;
            $tipoactividad->estecnico = $request->estecnico;

        $tipoactividad->save();

    }
}
