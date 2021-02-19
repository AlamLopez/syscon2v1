<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generalidades;

class GeneralidadesController extends Controller
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
            $generalidades = Generalidades::orderBy('id', 'desc')->paginate(10);
        }else{
            $generalidades = Generalidades::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(10);;
        }

        return [
            
            'pagination' => [
                'total'         => $generalidades->total(),
                'current_page'  => $generalidades->currentPage(),
                'per_page'      => $generalidades->perPage(),
                'last_page'     => $generalidades->lastPage(),
                'from'          => $generalidades->firstItem(),
                'to'            => $generalidades->lastItem(),
            ],

            'generalidades' => $generalidades

        ];

    }

     public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $generalidades = new Generalidades();

            $generalidades->empresa = $request->empresa;
            $generalidades->rector = $request->rector;
            $generalidades->vicerector = $request->vicerector;
            $generalidades->facultad = $request->facultad;
            $generalidades->decano = $request->decano;
            $generalidades->vicedecano = $request->vicedecano;
			$generalidades->ciclo = $request->ciclo;
            $generalidades->anio = $request->anio;
            $generalidades->inicio = $request->inicio;
            $generalidades->final = $request->final;

        $generalidades->save();

    }

public function update(Request $request)
    {
        /**
         * Actualizar en la BD del sistema el registro seleccionado
         */

        if(!$request->ajax()) return redirect('/');

        $generalidades = Generalidades::findOrFail($request->id);

            $generalidades->empresa = $request->empresa;
            $generalidades->rector = $request->rector;
            $generalidades->vicerector = $request->vicerector;
            $generalidades->facultad = $request->facultad;
            $generalidades->decano = $request->decano;
            $generalidades->vicedecano = $request->vicedecano;
			$generalidades->ciclo = $request->ciclo;
            $generalidades->anio = $request->anio;
            $generalidades->inicio = $request->inicio;
            $generalidades->final = $request->final;

        $generalidades->save();

    }



}
