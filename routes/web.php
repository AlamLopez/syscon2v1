<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('contenido.contenido');
});

Route::get('/roles', 'RolController@index');
Route::get('/roles/selectRol', 'RolController@selectRol');

Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/unico/{usuario}', 'UserController@unico');
Route::get('/usuarios/unico/{usuario}/{user_id}', 'UserController@unico2');
Route::get('/usuarios/unicoEmail/{email}', 'UserController@unico3');
Route::get('/usuarios/unicoEmail/{email}/{user_id}', 'UserController@unico4');
Route::get('/usuarios/getUser', 'UserController@getUser');
Route::get('/usuarios/selectUser', 'UserController@selectUser');
Route::post('/usuarios/registrar', 'UserController@store');
Route::put('/usuarios/actualizar', 'UserController@update');
Route::put('/usuarios/desactivar', 'UserController@desactivar');
Route::put('/usuarios/activar', 'UserController@activar');

Route::get('/empleados', 'EmpleadoController@index');
Route::get('/empleados/unico/{empleado}', 'EmpleadoController@unico');
Route::get('/empleados/unico/{empleado}/{Empleado_id}', 'EmpleadoController@unico2');
Route::get('/empleados/unicoEmail/{email}', 'EmpleadoController@unico3');
Route::get('/empleados/unicoEmail/{email}/{Empleado_id}', 'EmpleadoController@unico4');
Route::get('/empleados/getEmpleado', 'EmpleadoController@getEmpleado');
Route::get('/empleados/selectEmpleado', 'EmpleadoController@selectEmpleado');
Route::post('/empleados/registrar', 'EmpleadoController@store');
Route::put('/empleados/actualizar', 'EmpleadoController@update');
Route::put('/empleados/desactivar', 'EmpleadoController@desactivar');
Route::put('/empleados/activar', 'EmpleadoController@activar');
Route::get('/empleados/mostrar/{id_empleado}',    'EmpleadoController@mostrar');
Route::get('/obtenerImagenEmpleado/{filename}', 'EmpleadoController@getImageB64');

Route::get('/departamentos/selectDepartamento', 'EmpleadoController@selectDepartamento');
Route::get('/municipios/selectMunicipio', 'EmpleadoController@selectMunicipio');
Route::get('/generalidades', 'GeneralidadesController@index');
Route::put('/generalidades/actualizar', 'GeneralidadesController@update');

Route::post('/generalidades/registrar', 'GeneralidadesController@store');

Route::get('/tipoactividades', 'TipoActividadController@index');
Route::post('/tipoactividades/registrar', 'TipoActividadController@store');
Route::put('/tipoactividades/actualizar', 'TipoActividadController@update');

Route::get('/subactividades', 'SubActividadController@index');
Route::post('/subactividades/registrar', 'SubActividadController@store');
Route::put('/subactividades/actualizar', 'SubActividadController@update');

Route::get('/actividades', 'ActividadController@index');
Route::post('/actividades/registrar', 'ActividadController@store');
Route::put('/actividades/actualizar', 'ActividadController@update');
Route::get('/actividades/selectSubActividad', 'ActividadController@selectSubActividad');
Route::get('/actividades/selectTipoActividad', 'ActividadController@selectTipoActividad');

Route::get('/asignaractividades', 'AsignarActividadController@index');
Route::post('/asignaractividades/registrar', 'AsignarActividadController@store');
Route::put('/asignaractividades/actualizar', 'AsignarActividadController@update');
Route::get('/asignaractividades/actividades', 'AsignarActividadController@selectActividades');
Route::get('/asignaractividades/selectTipoActividad', 'AsignarActividadController@selectTipoActividad');
Route::get('/asignaractividades/selectSubActividad', 'AsignarActividadController@selectSubActividad');
Route::get('/asignaractividades/selectActividad', 'AsignarActividadController@selectActividad');
Route::get('/asignaractividades/selectAsignaciones', 'AsignarActividadController@selectAsignaciones');

Route::get('/tipocontratos', 'TipoContratosController@index');
Route::post('/tipocontratos/registrar', 'TipoContratosController@store');
Route::put('/tipocontratos/actualizar', 'TipoContratosController@update');


Route::get('/controlhorarios', 'ControlHorariosController@index');
Route::post('/controlhorarios/registrar', 'ControlHorariosController@store');
Route::put('/controlhorarios/actualizar', 'ControlHorariosController@update');
Route::get('/controlhorarios/selectTipoContrato', 'ControlHorariosController@selectTipoContrato');
Route::get('/controlhorarios/selectTipoActividad', 'ControlHorariosController@selectTipoActividad');

Route::get('/acronimo', 'AcronimoController@index');
Route::post('/acronimo/registrar', 'AcronimoController@store');
Route::put('/acronimo/actualizar', 'AcronimoController@update');
Route::get('/acronimo/selectAcronimo', 'AcronimoController@selectAcronimo');

Route::get('/categoria', 'CategoriaController@index');
Route::post('/categoria/registrar', 'CategoriaController@store');
Route::put('/categoria/actualizar', 'CategoriaController@update');
Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

Route::get('/unidadacademica', 'UnidadAcademicaController@index');
Route::post('/unidadacademica/registrar', 'UnidadAcademicaController@store');
Route::put('/unidadacademica/actualizar', 'UnidadAcademicaController@update');
Route::get('/unidadacademica/selectUnidadAcademica', 'UnidadAcademicaController@selectUnidadAcademica');
Route::get('/unidadacademica/info', 'UnidadAcademicaController@info');
