<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AsignarActividad;
use App\Actividad;
use App\SubActividad;
use App\TipoActividad;
use App\Empleado;


class AsignarActividadController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Desplegar el listado de usuarios registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */
        $empleado = Empleado::findOrFail($request->id);
          return ['empleado' => $empleado];    
        /*if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){

            $asignaractividad = Actividad::join('tipo_actividads', 'tipo_actividads.id', '=', 'actividads.idtipoactividad')->join('sub_actividads', 'sub_actividads.id', '=', 'actividads.idsubactividad')
                        ->select('actividads.id', 'actividads.descripcion', 'actividads.idsubactividad', 'sub_actividads.descripcion as subactividad', 'actividads.idtipoactividad','tipo_actividads.descripcion as tipoactividad')
                        ->orderBy('actividads.id', 'desc')
                        ->paginate(1);

        }else{

            $asignaractividad = Actividad::join('tipo_actividads', 'tipo_actividads.id', '=', 'actividads.idtipoactividad')->join('sub_actividads', 'sub_actividads.id', '=', 'actividads.idsubactividad')
                        ->select('actividads.id', 'actividads.descripcion', 'actividads.idsubactividad', 'sub_actividads.descripcion as subactividad', 'actividads.idtipoactividad','tipo_actividads.descripcion as tipoactividad')
                        ->where($criterio, 'like', '%' . $buscar . '%')
                        ->orderBy('actividads.id', 'desc')
                        ->paginate(1);

        }

        return [
            
            'pagination' => [
                'total'         => $asignaractividad->total(),
                'current_page'  => $asignaractividad->currentPage(),
                'per_page'      => $asignaractividad->perPage(),
                'last_page'     => $asignaractividad->lastPage(),
                'from'          => $asignaractividad->firstItem(),
                'to'            => $asignaractividad->lastItem(),
            ],

            'asignaractividad' => $asignaractividad

        ];*/

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

        $asignaractividad = new AsignarActividad();

            $asignaractividad->actividad = $request->actividad;
            $asignaractividad->tipoactividad = $request->tipoactividad;
            $asignaractividad->subactividad = $request->subactividad;
            $asignaractividad->idempleado = $request->idempleado;
            $asignaractividad->idactividad = $request->idactividad;
            $asignaractividad->ciclo = $request->ciclo;
            $asignaractividad->anio = $request->anio;
            $asignaractividad->dia = $request->dia;
            $asignaractividad->inicio = $request->inicio;
            $asignaractividad->fin = $request->fin;

        $asignaractividad->save();

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

        dd($request->all());

        $asignaractividad = AsignarActividad::findOrFail($request->id);

            $asignaractividad->actividad = $request->actividad;
            $asignaractividad->tipoactividad = $request->tipoactividad;
            $asignaractividad->subactividad = $request->subactividad;
            $asignaractividad->idempleado = $request->idempleado;
            $asignaractividad->idactividad = $request->idactividad;
            $asignaractividad->ciclo = $request->ciclo;
            $asignaractividad->anio = $request->anio;
            $asignaractividad->dia = $request->dia;
            $asignaractividad->inicio = $request->inicio;
            $asignaractividad->fin = $request->fin;

        $asignaractividad->save();

    }

    public function selectActividades(Request $request)
    {
        /**
         * Devuelve todos los tipos de actividades
         */

        $actividades = Actividad::all();

          return ['actividades' => $actividades];
        
    }

    public function selectTipoActividad(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $tipoactividades = TipoActividad::select('id', 'descripcion')->where('id', $request->id)->orderBy('descripcion', 'asc')->get();

        return ['tipoactividades' => $tipoactividades];
        
    }

    public function selectSubActividad(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $subactividades = SubActividad::select('id', 'descripcion')->where('id', $request->id)->orderBy('descripcion', 'asc')->get();

        return ['subactividades' => $subactividades];
        
        
    }

    public function selectActividad(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $actividad = Actividad::select('id', 'idtipoactividad','idsubactividad','descripcion')->where('id', $request->id)->orderBy('id', 'asc')->get();

        return ['actividad' => $actividad];
        
        
    }

    public function selectAsignaciones(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $asignaciones = AsignarActividad::select('actividad','dia','inicio','fin')->where('idempleado', $request->id)->orderBy('id', 'asc')->get();

        return response()->json(["My events" => $asignaciones]);
        
    }

}
