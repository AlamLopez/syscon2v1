<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividad;
use App\Actividad;
use App\SubActividad;

class ActividadController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Desplegar el listado de usuarios registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){

            $actividades = Actividad::join('tipo_actividads', 'tipo_actividads.id', '=', 'actividads.idtipoactividad')->leftjoin('sub_actividads', 'sub_actividads.id', '=', 'actividads.idsubactividad')
                        ->select('actividads.id', 'actividads.descripcion', 'actividads.idsubactividad', 'sub_actividads.descripcion as subactividad', 'actividads.idtipoactividad','tipo_actividads.descripcion as tipoactividad')
                        ->orderBy('actividads.id', 'desc')
                        ->paginate(5);

        }else{

            $actividades = Actividad::join('tipo_actividads', 'tipo_actividads.id', '=', 'actividads.idtipoactividad')->leftjoin('sub_actividads', 'sub_actividads.id', '=', 'actividads.idsubactividad')
                        ->select('actividads.id', 'actividads.descripcion', 'actividads.idsubactividad', 'sub_actividads.descripcion as subactividad', 'actividads.idtipoactividad','tipo_actividads.descripcion as tipoactividad')
                        ->where($criterio, 'like', '%' . $buscar . '%')
                        ->orderBy('actividads.id', 'desc')
                        ->paginate(5);

        }

        return [
            
            'pagination' => [
                'total'         => $actividades->total(),
                'current_page'  => $actividades->currentPage(),
                'per_page'      => $actividades->perPage(),
                'last_page'     => $actividades->lastPage(),
                'from'          => $actividades->firstItem(),
                'to'            => $actividades->lastItem(),
            ],

            'actividades' => $actividades

        ];

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $actividades = new Actividad();

            $actividades->descripcion = $request->descripcion;
            if ($request->idsubactividad == 0) {
                $actividades->idsubactividad = null;
            }
            else {
                $actividades->idsubactividad = $request->idsubactividad;
            }
            $actividades->idtipoactividad = $request->idtipoactividad;

        $actividades->save();

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

        $actividades = Actividad::findOrFail($request->id);

            $actividades->descripcion = $request->descripcion;
            if ($request->idsubactividad == 0) {
                $actividades->idsubactividad = null;
            }
            else {
                $actividades->idsubactividad = $request->idsubactividad;
            }
            $actividades->idtipoactividad = $request->idtipoactividad;

        $actividades->save();

    }

    public function selectSubActividad(Request $request)
    {
        /**
         * Devuelve todas las subactividades 
         */

        $subactividades = SubActividad::all();

        return ['subactividades' => $subactividades];
        
    }

    public function selectTipoActividad(Request $request)
    {
        /**
         * Devuelve todos los tipos de actividades
         */

        $tipoactividades = TipoActividad::all();

        return ['tipoactividades' => $tipoactividades];
        
    }
}
