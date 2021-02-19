<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadAcademica;

class UnidadAcademicaController extends Controller
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
            $unidadacademica = UnidadAcademica::orderBy('id', 'desc')->paginate(10);
        }else{
            $unidadacademica = UnidadAcademica::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $unidadacademica->total(),
                'current_page'  => $unidadacademica->currentPage(),
                'per_page'      => $unidadacademica->perPage(),
                'last_page'     => $unidadacademica->lastPage(),
                'from'          => $unidadacademica->firstItem(),
                'to'            => $unidadacademica->lastItem(),
            ],

            'unidadacademica' => $unidadacademica

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $unidadacademica = new UnidadAcademica();

            $unidadacademica->nombre = $request->nombre;
            $unidadacademica->jefe = $request->jefe;

        $unidadacademica->save();

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

        $unidadacademica = UnidadAcademica::findOrFail($request->id);

            $unidadacademica->nombre = $request->nombre;
            $unidadacademica->jefe = $request->jefe;

        $unidadacademica->save();

    }

    public function selectUnidadAcademica(Request $request)
    {
        /**
         * Devuelve las unidades cademicas registrados con condicion Activo
         */

        $unidadesacademicas = UnidadAcademica::select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return ['unidadesacademicas' => $unidadesacademicas];
        
    }

    public function info(Request $request)
    {
        $unidadacademica = UnidadAcademica::findOrFail($request->id_unidadacademica);
        
        return ['unidadacademica' => $unidadacademica];
    }

}
