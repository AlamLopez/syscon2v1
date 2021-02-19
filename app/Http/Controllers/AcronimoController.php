<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acronimo;

class AcronimoController extends Controller
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
            $acronimo = Acronimo::orderBy('id', 'desc')->paginate(10);
        }else{
            $acronimo = Acronimo::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        //dd($tipoactividades);
        return [
            
            'pagination' => [
                'total'         => $acronimo->total(),
                'current_page'  => $acronimo->currentPage(),
                'per_page'      => $acronimo->perPage(),
                'last_page'     => $acronimo->lastPage(),
                'from'          => $acronimo->firstItem(),
                'to'            => $acronimo->lastItem(),
            ],

            'acronimo' => $acronimo

        ];
    }

    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $acronimo = new Acronimo();

            $acronimo->acronimo = $request->acronimo;

        $acronimo->save();

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

        $acronimo = Acronimo::findOrFail($request->id);

            $acronimo->acronimo = $request->acronimo;

        $acronimo->save();

    }

    public function selectAcronimo(Request $request)
    {
        /**
         * Devuelve las unidades cademicas registrados con condicion Activo
         */

        $acronimos = Acronimo::select('id', 'acronimo')->orderBy('acronimo', 'asc')->get();

        return ['acronimos' => $acronimos];
        
    }
}

