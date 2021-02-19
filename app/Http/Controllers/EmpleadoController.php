<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

use App\Empleado;
use App\Departamento;
use App\Municipio;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Desplegar el listado de empleados registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){

            $empleados = Empleado::select('empleados.*', 'acronimos.acronimo')
                                ->join('unidad_academicas', 'unidad_academicas.id', '=', 'empleados.id_unidadacademica')
                                ->join('categorias', 'categorias.id', '=', 'empleados.id_categoria')
                                ->join('acronimos', 'acronimos.id', '=', 'empleados.id_acronimo')
                                ->paginate(5);

        }else{

            $empleados = Empleado::select('empleados.*', 'acronimos.acronimo')
                                ->join('unidad_academicas', 'unidad_academicas.id', '=', 'empleados.id_unidadacademica')
                                ->join('categorias', 'categorias.id', '=', 'empleados.id_categoria')
                                ->join('acronimos', 'acronimos.id', '=', 'empleados.id_acronimo')
                                ->where($criterio, 'like', '%' . $buscar . '%')
                                ->paginate(5);

        }

        return [
            
            'pagination' => [
                'total'         => $empleados->total(),
                'current_page'  => $empleados->currentPage(),
                'per_page'      => $empleados->perPage(),
                'last_page'     => $empleados->lastPage(),
                'from'          => $empleados->firstItem(),
                'to'            => $empleados->lastItem(),
            ],

            'empleados' => $empleados

        ];

    }

    public function store(Request $request)
    {

        $fotos = $request->disatestados;

        if(!empty($fotos)){

            $nombres = array();
            $i = 0;

            foreach($fotos as $item){

                $i++;

                $img = $this->getB64Image($item);

                $img_extension = $this->getB64Extension($item);

                $img_name = 'atestado' . $i . '_' . date("Y") . date("m") . date("d") . "_" . date("H") . date("i") . date("s") . "_" . $i . "." . $img_extension;

                Storage::disk('public')->put($img_name, $img);

                $nombres[] = $img_name;

            }

            $nombres_fotos = implode(',', $nombres);

        }else{

            $nombres_fotos = null;

        }

        if(!$request->ajax()) return redirect('/');

        $empleado = new Empleado();

            $empleado->nombre = $request->nombre;
            $empleado->id_acronimo = $request->id_acronimo;
            $empleado->profesion = $request->profesion;
            $empleado->direccion = $request->direccion;
            $empleado->genero = $request->genero;
            $empleado->fecha_nacimiento = $request->fecha_nacimiento;
            $empleado->edad = $request->edad;
            $empleado->telefono1 = $request->telefono1;
            $empleado->telefono2 = $request->telefono2;
            $empleado->celular = $request->celular;
            $empleado->id_categoria = $request->id_categoria;
            $empleado->dui = $request->dui;
            $empleado->fechavencimiento=$request->fechavencimiento;
            $empleado->nit = $request->nit;
            $empleado->afp = $request->afp;
            $empleado->cargo = $request->cargo;
            $empleado->id_unidadacademica = $request->id_unidadacademica;
            $empleado->desatestados = $request->desatestados;
            $empleado->disatestados = $nombres_fotos;
            $empleado->id_user = 1;
            $empleado->id_municipio = $request->id_municipio;
            $empleado->condicion = true;

        $empleado->save();

    }

    public function update(Request $request)
    {

        if(!$request->ajax()) return redirect('/');

        //dd($request->all());

        $fotos_nuevas = $request->fotosnuevas;

        $fotos_viejas = $request->fotosviejas;

        // Cuando cambian las fotos de la actividad tecnica
        if(!empty($fotos_nuevas)){

            $ruta = storage_path() . '/app/public/';

            $nombres = array();
            $i = 0;

            if(!empty($fotos_viejas)){

                foreach($fotos_viejas as $item){
                    unlink($ruta . $item);
                }

            }

            foreach($fotos_nuevas as $item){

                $i++;

                $img = $this->getB64Image($item);

                $img_extension = $this->getB64Extension($item);

                $img_name = 'atestado' . $i . '_' . date("Y") . date("m") . date("d") . "_" . date("H") . date("i") . date("s") . "_" . $i . "." . $img_extension;

                Storage::disk('public')->put($img_name, $img);

                $nombres[] = $img_name;

            }

            $nombres_fotos = implode(',', $nombres);

        }elseif(!empty($fotos_viejas)){
            $nombres_fotos = implode(',', $fotos_viejas);
        }else{
            $nombres_fotos = null;
        }

        $empleado = Empleado::findOrFail($request->empleado_id);

            $empleado->nombre = $request->nombre;
            $empleado->id_acronimo = $request->id_acronimo;
            $empleado->profesion = $request->profesion;
            $empleado->direccion = $request->direccion;
            $empleado->genero = $request->genero;
            $empleado->fecha_nacimiento = $request->fecha_nacimiento;
            $empleado->edad = $request->edad;
            $empleado->telefono1 = $request->telefono1;
            $empleado->telefono2 = $request->telefono2;
            $empleado->celular = $request->celular;
            $empleado->id_categoria = $request->id_categoria;
            $empleado->dui = $request->dui;
            $empleado->fechavencimiento=$request->fechavencimiento;
            $empleado->nit = $request->nit;
            $empleado->afp = $request->afp;
            $empleado->cargo = $request->cargo;
            $empleado->id_unidadacademica = $request->id_unidadacademica;
            $empleado->desatestados = $request->desatestados;
            $empleado->disatestados = $nombres_fotos;
            $empleado->id_user = 1;
            $empleado->id_municipio = $request->id_municipio;
            $empleado->condicion = true;
        
        $empleado->save();

    }

    public function selectDepartamento(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $departamentos = Departamento::select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return ['departamentos' => $departamentos];
        
    }

    public function selectMunicipio(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $municipios = Municipio::select('id', 'nombre')->where('id_departamento', $request->id_departamento)->orderBy('nombre', 'asc')->get();

        return ['municipios' => $municipios];
        
    }

    public function getB64Image($base64_image)
    {  
        /**
         * Obtener el String base-64 de los datos
         * Decodificar ese string y devolver los datos de la imagen 
         * Retornamos el string decodificado
         */

        $image_service_str = substr($base64_image, strpos($base64_image, ",")+1);
        
        $image = base64_decode($image_service_str);   
       
        return $image; 

    }

    public function getB64Extension($base64_image, $full=null)
    {
       /**
         * Obtener mediante una expresión regular la extensión imagen y guardarla
         * en la variable "img_extension" 
         * Dependiendo si se pide la extensión completa o no retornar el arreglo con
         * los datos de la extensión en la posición 0 - 1
         */  
                 
        preg_match("/^data:image\/(.*);base64/i",$base64_image, $img_extension);
 
        return ($full) ?  $img_extension[0] : $img_extension[1];  

    }

    public function getImageB64($filename)
    {
        //Obtener la imagen del disco creado anteriormente de acuerdo al nombre de
        // la imagen solicitada
        $file = Storage::disk('public')->get($filename);
        
        // Retornar una respuesta de tipo 200 con el archivo de la Imagen
        return new Response($file,200);
    }

    public function desactivar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Desactivado
         */

        if(!$request->ajax()) return redirect('/');

        $empleado = Empleado::findOrFail($request->id);

            $empleado->condicion = false;

        $empleado->save();

    }

    public function activar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Activado
         */

        if(!$request->ajax()) return redirect('/');

        $empleado = Empleado::findOrFail($request->id);

            $empleado->condicion = true;

        $empleado->save();

    }

    public function mostrar($id_empleado)
    {
        /** Consulta los datos de la actividad tecnica seleccionada por el usuario */

        $empleado = Empleado::select('empleados.*', 'unidad_academicas.jefe', 'unidad_academicas.nombre as unidad', 
                                    'categorias.categoria', 'acronimos.acronimo', 'departamentos.nombre as id_departamento', 
                                    'municipios.nombre as id_municipio', 'departamentos.id as iddepartamento', 
                                    'municipios.id as idmunicipio', 'acronimos.id as idacronimo', 'categorias.id as idcategoria',
                                    'unidad_academicas.id as idunidadacademica')
                                ->join('unidad_academicas', 'unidad_academicas.id', '=', 'empleados.id_unidadacademica')
                                ->join('categorias', 'categorias.id', '=', 'empleados.id_categoria')
                                ->join('acronimos', 'acronimos.id', '=', 'empleados.id_acronimo')
                                ->join('municipios', 'municipios.id', '=', 'empleados.id_municipio')
                                ->join('departamentos', 'departamentos.id', '=', 'municipios.id_departamento')
                                ->where('empleados.id', $id_empleado)
                                ->first();

        if($empleado->disatestados != null){
    
            $empleado->disatestados = explode(',', $empleado->disatestados);

        }

        return ['empleado' => $empleado];
    }
    
}
