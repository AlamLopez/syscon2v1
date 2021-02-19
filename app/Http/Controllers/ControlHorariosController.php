<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContratos;
use App\TipoActividad;
use App\ControlHorarios;

class ControlHorariosController extends Controller
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

            $controlhorarios = ControlHorarios::join('tipo_contratos', 'tipo_contratos.id', '=', 'control_horarios.idtipocontrato')->join('tipo_actividads', 'tipo_actividads.id', '=', 'control_horarios.idtipoactividad')
                        ->select('control_horarios.id', 'control_horarios.descripcion', 'control_horarios.idtipocontrato', 'tipo_contratos.descripcion as subactividad', 'control_horarios.idtipoactividad','tipo_actividads.descripcion as tipoactividad', 'control_horarios.horasemana')
                        ->orderBy('control_horarios.id', 'desc')
                        ->paginate(5);

        }else{

             $controlhorarios = ControlHorarios::join('tipo_contratos', 'tipo_contratos.id', '=', 'control_horarios.idtipocontrato')->join('tipo_actividads', 'tipo_actividads.id', '=', 'control_horarios.idtipoactividad')
                        ->select('control_horarios.id', 'control_horarios.descripcion', 'control_horarios.idtipocontrato', 'tipo_contratos.descripcion as subactividad', 'control_horarios.idtipoactividad','tipo_actividads.descripcion as tipoactividad')
                        ->where($criterio, 'like', '%' . $buscar . '%')
                        ->orderBy('control_horarios.id', 'desc')
                        ->paginate(5);

        }

        return [
            
            'pagination' => [
                'total'         => $controlhorarios->total(),
                'current_page'  => $controlhorarios->currentPage(),
                'per_page'      => $controlhorarios->perPage(),
                'last_page'     => $controlhorarios->lastPage(),
                'from'          => $controlhorarios->firstItem(),
                'to'            => $controlhorarios->lastItem(),
            ],

            'controlhorarios' => $controlhorarios

        ];

    }

     public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $control = new ControlHorarios();

            $control->descripcion = $request->descripcion;
            $control->horasemana = $request->horasemana;
            $control->idtipoactividad = $request->idtipoactividad;
            $control->idtipocontrato = $request->idtipocontrato;
         

        $control->save();

    }

public function update(Request $request)
    {
        /**
         * Actualizar en la BD del sistema el registro seleccionado
         */

        if(!$request->ajax()) return redirect('/');

        $control = ControlHorarios::findOrFail($request->id);

            $control->descripcion = $request->descripcion;
            $control->horasemana = $request->horasemana;
            $control->idtipoactividad = $request->idtipoactividad;
            $control->idtipocontrato = $request->idtipocontrato;
         

        $control->save();

    }

       public function selectTipoContrato(Request $request)
    {
        /**
         * Devuelve todas las subactividades 
         */

        $tipocontrato = TipoContratos::all();

        return ['tipocontrato' => $tipocontrato];
        
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
