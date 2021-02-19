<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">HOME</li>
            <li class="breadcrumb-item"><a href="#">ADMIN</a></li>
            <li class="breadcrumb-item active">DASHBOARD</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> LISTADO DE EMPLEADOS
                    <button type="button" @click="abrirModal('empleado', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;NUEVO
                    </button>
                </div>
                <div class="card-body">
                    <template v-if="asignar">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                    <option value="empleados.nombre">NOMBRE</option>
                                    <option value="acronimo">ACRONIMO</option>
                                    <option value="dui">DUI</option>
                                    <option value="profesion">PROFESION</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarEmpleados(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NOMBRE</th>
                                    <th style="text-align: center;">ACRONIMO</th>
                                    <th style="text-align: center;">DUI</th>
                                    <th style="text-align: center;">ESTADO</th>
                                    <th style="text-align: center;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empleado in arrayEmpleados" :key="empleado.id">
                                    <td style="text-align: center;" v-text="empleado.nombre"></td>
                                    <td style="text-align: center;" v-text="empleado.acronimo"></td>
                                    <td style="text-align: center;" v-text="empleado.dui"></td>
                                    <td style="text-align: center;">
                                        <div v-if="empleado.condicion">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('empleado', 'actualizar', empleado)" class="btn btn-warning btn-sm" title="EDITAR USUARIO">
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="empleado.condicion">
                                            <button type="button" @click="desactivarEmpleado(empleado.id)" class="btn btn-danger btn-sm" title="DESACTIVAR USUARIO">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" @click="activarEmpleado(empleado.id)" class="btn btn-info btn-sm" title="ACTIVAR USUARIO">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                        <template>
                                            <button type="button" @click="abrirModal('empleado', 'leer', empleado)" class="btn btn-info btn-sm" title="VER INFORMACION EMPLEADO">
                                                <i class="icon-eye"></i>
                                            </button>
                                        </template>
                                        <template>
                                            <button type="button" class="btn btn-info btn-sm" @click="vistaAsignarEmpleado(empleado)" title="ASIGNAR ACTIVIDAD">
                                                <i class="fa fa-external-link"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </template>
                    <template v-else> 
                        <button type="button" class="btn btn-info btn-sm" @click="volverListaEmpleado()" title="VOLVER A EMPLEADOS">VOLVER</button>
                        
                        <div class="card-body">
                            <h2 class="m-0 text-dark" v-text="'Asignación de actividades: '+ciclo+' - '+anio"> </h2>
                            <h1 class="m-0 text-dark" v-text="'Empleado: '+empleado.dui+' - '+empleado.nombre"></h1>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" >ACTIVIDAD (*)</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="idactividad" @change="selectActividad(idactividad)">
                                                <option value="0">SELECCIONE UNA ACTIVIDAD</option>
                                                <option v-for="actividad in arrayActividades" :key="actividad.id" :value="actividad.id" v-text="actividad.descripcion"></option>
                                            </select>
                                        </div>
                            <label class="col-md-3 form-control-label" >TIPOACTIVIDAD (*)</label>
                            <label class="col-md-3 form-control-label" v-text="tipoactividad"></label>
                            <label class="col-md-3 form-control-label" >HORA INICIO (*)</label>
                                        <div class="col-md-3">
                                            <input type="time" v-model="inicio">
                                        </div>                                
                            <label class="col-md-3 form-control-label" >SUBACTIVIDAD (*)</label>
                            <label class="col-md-3 form-control-label" v-text="subactividad"></label>
                            <label class="col-md-3 form-control-label" >HORA FIN (*)</label>
                                        <div class="col-md-3">
                                                <input type="time" v-model="fin">
                                        </div>                                
                            <label class="col-md-3 form-control-label" >DIA (*)</label>
                                        <div class="col-md-3">
                                            <select v-model="dia">
                                                <option  value="0">Domingo</option>
                                                <option  value="1">Lunes</option>
                                                <option  value="2">Martes</option>
                                                <option  value="3">Miercoles</option>
                                                <option  value="4">Jueves</option>
                                                <option  value="5">Viernes</option>
                                                <option  value="6">Sabado</option>
                                            </select>
                                        </div>
                            <label class="col-md-3 form-control-label" >GUARDAR (*)</label>
                                        <div class="col-md-3">
                                                <input type="button" @click="registrarAsignacionesActividades()" value="Guardar">
                                        </div>
                        
                        </div>
                        <template>
                            <FullCalendar 
                            :options="calendarOptions" 
                            :events="calendarEvents"
                            
                            />
                        </template>
                        </div>
                    </template>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <!--Inicio del modal empleado-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template v-if="tipoAccion == 1 || tipoAccion == 2">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <fieldset>
                                    <legend>INFORMACION PERSONAL:</legend>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">NOMBRE COMPLETO(*):</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="nombre" placeholder="NOMBRE DEL EMPLEADO" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">DIRECCION SEGÚN DUI0:</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" v-model="direccion" placeholder="DIRECCION DEL EMPLEADO" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <!--template v-if="tipoAccion==1"-->
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">DEPARTAMENTO:</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_departamento" @change="selectMunicipio(id_departamento)">
                                                    <option value="0">SELECCIONE UN DEPARTAMENTO</option>
                                                    <option v-for="departamento in arrayDepartamento" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">MUNICIPIO:</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_municipio">
                                                    <option value="">SELECCIONE UN MUNICIPIO</option>
                                                    <option v-for="municipio in arrayMunicipio" :key="municipio.id" :value="municipio.id" v-text="municipio.nombre"></option>
                                                </select>
                                            </div>
                                        </div>
                                    <!--/template-->
                                     <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">FECHA DE NACIMIENTO (*):</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" v-model="fecha_nacimiento" @change="calcularEdad(fecha_nacimiento)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">EDAD (*):</label>
                                        <div class="col-md-9">
                                            <label class="form-control-label" v-text="edad"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">GENERO (*)</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="genero">
                                                <option value="">SELECCIONE UN GENERO</option>
                                                <option value="1">MASCULINO</option>
                                                <option value="0">FEMENINO</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">TELEFONO 1 (*):</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'####-####'" v-model="telefono1" placeholder="TELEFONO DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">TELEFONO 2:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'####-####'" v-model="telefono2" placeholder="TELEFONO DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">CELULAR:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'####-####'" v-model="celular" placeholder="CELULAR DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">DUI:(*)</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'########-#'" v-model="dui" placeholder="DUI DEL EMPLEADO">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">FECHA DE VENCIMIENTO DUI: (*)</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control"  v-model="fechavencimiento" placeholder="FECHA VENCIMIENTO DEL DUI">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">NIT: (*)</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'####-######-###-#'" v-model="nit" placeholder="NIT DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">AFP/INPEP(*):</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-mask="'############'" v-model="afp" placeholder="AFP/INPEP DEL EMPLEADO">
                                        </div>
                                    </div>
                                    
                                </fieldset>
                                <fieldset>
                                    <legend>INFORMACION PROFESIONAL:</legend>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">ACRONIMO (*):</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="id_acronimo">
                                                <option value="0">SELECCIONE UN ACRONIMO</option>
                                                <option v-for="acronimo in arrayAcronimo" :key="acronimo.id" :value="acronimo.id" v-text="acronimo.acronimo"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">PROFESION:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="profesion" placeholder="PROFESION DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">CATEGORIA (*):</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="id_categoria">
                                                <option value="0">SELECCIONE UNA CATEGORIA</option>
                                                <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.categoria"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">CARGO (*):</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="cargo" placeholder="CARGO DEL EMPLEADO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">UNIDAD (*)</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="id_unidadacademica" @change="obtenerInfoUnidadAcademica(id_unidadacademica)">
                                                <option value="0">SELECCIONE UNA UNIDAD ACADEMICA</option>
                                                <option v-for="unidadacademica in arrayUnidadAcademica" :key="unidadacademica.id" :value="unidadacademica.id" v-text="unidadacademica.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">JEFE (*):</label>
                                        <div class="col-md-9">
                                            <label class="form-control-label" v-text="jefe"></label>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                                <fieldset>
                                    <legend>ATESTADOS:</legend>
                                    <!--template v-if="tipoAccion==1"-->
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">ATESTADOS DESC:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="desatestados" placeholder="ATESTADOS">
                                            </div>
                                        </div>
                                        <div class="card-body border">
                                            <template v-if="tipoAccion==1">
                                                <div class="row">
                                                    <div class="col-md-12 form-group row">
                                                        <label class="col-md-3 col-form-label" for="file-multiple-input"><b>ATESTADOS:</b></label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="file"
                                                                multiple
                                                                :ref="'image'"
                                                                accept="image/*"
                                                                @change="onFileChange"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div v-for="(image, key) in images" :key="key" class="col-md-4">
                                                        <img class="img-thumbnail img-rounded img-responsive" :ref="'image'" />
                                                    </div>
                                                </div>
                                            </template>
                                            <template v-if="tipoAccion==2">
                                                <div class="row">
                                                    <div class="col-md-12 form-group row">
                                                        <label class="col-md-3 col-form-label" for="file-multiple-input"><b>ATESTADOS:</b></label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="file"
                                                                multiple
                                                                :ref="'image'"
                                                                accept="image/*"
                                                                @change="onFileChange2"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="fotos_modo==1" class="form-group row">
                                                    <div v-for="(image, key) in fotosviejas" :key="key" class="col-md-4">
                                                        <img class="img-thumbnail img-rounded img-responsive" :src="'/obtenerImagenEmpleado/'+image" />
                                                    </div>
                                                </div>
                                                <div v-else-if="fotos_modo==2" class="form-group row">
                                                    <div v-for="(image, key) in fotosnuevas" :key="key" class="col-md-4">
                                                        <img class="img-thumbnail img-rounded img-responsive" :ref="'fotosnuevas'" />
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    <!--/template-->
                                </fieldset>
                                <div v-show="errorEmpleado" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEmpleado" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </template>
                        <template v-if="tipoAccion == 3">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">NOMBRE:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="nombre"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">ACRONIMO:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="id_acronimo"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">PROFESION:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="profesion"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">DIRECCION:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="direccion"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">GENERO:</label>
                                <template v-if="genero">
                                    <div class="col-md-9">
                                        <label class="form-control-label" v-text="'MASCULINO'"></label>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="col-md-9">
                                        <label class="form-control-label" v-text="'FEMENINO'"></label>
                                    </div>
                                </template>
                                 <label class="col-md-3 form-control-label" for="text-input">EDAD:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="edad"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">FECHA DE NACIMIENTO:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="fecha_nacimiento"></label>
                                </div>
                               
                                <label class="col-md-3 form-control-label" for="text-input">TELEFONO 1:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="telefono1"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">TELEFONO 2:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="telefono2"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">CELULAR:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="celular"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">CATEGORIA:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="id_categoria"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">DUI:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="dui"></label>
                                </div>
                                 <label class="col-md-3 form-control-label" for="text-input">FECHA DE VENCIMIENTO DUI:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="fechavencimiento"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">NIT:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="nit"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">AFP/INPEP:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="afp"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">CARGO:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="cargo"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">UNIDAD:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="id_unidadacademica"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">JEFE:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="jefe"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">DEPARTAMENTO:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="id_departamento"></label>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input">MUNICIPIO:</label>
                                <div class="col-md-9">
                                    <label class="form-control-label" v-text="id_municipio"></label>
                                </div>
                                <div class="row">
                                    <div v-for="(image, key) in fotosviejas" :key="key" class="col-md-4">
                                        <img class="img-thumbnail img-rounded img-responsive" :src="'/obtenerImagenEmpleado/'+image" />
                                    </div>
                                </div>
                            </div>
                        </template>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                        <button type="button" v-if="tipoAccion==1" @click="registrarEmpleado()" class="btn btn-primary">GUARDAR</button>
                        <button type="button" v-if="tipoAccion==2" @click="actualizarEmpleado()" class="btn btn-primary">ACTUALIZAR</button>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
            
        </main>
</template>

<script>

    import FullCalendar from '@fullcalendar/vue'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import interactionPlugin from '@fullcalendar/interaction'
    import VueMask from 'v-mask'

    Vue.use(VueMask);

    export default {

        components: {
            FullCalendar // make the <FullCalendar> tag available
        },

        data (){

            return {
                
                calendarOptions: {
                    plugins: [ timeGridPlugin, interactionPlugin ],
                    initialView: 'timeGridWeek',
                    dateClick: this.handleDateClick,
                    themeSystem: 'bootstrap',
                    allDaySlot: false,

                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: false
                    },
                    locale: 'es',               
                    headerToolbar: {
                        left:   '',
                        center: '',
                        right:  ''
                    },
                    slotDuration: "01:00:00",
                    events: [
                      { title: 'event 1', start: '2021-01-31',end: '2021-02-31' }
                    ]
                },
                calendarEvents: [{
                    events(start, end, timezone, callback) {
                        axios.get('/asignaractividades/selectAsignaciones?id='+me.empleado_id).then(res => {
                            callback(res.data.eventList)
                        })
                    },
                    color: 'blue',
                    textColor: 'white',
                }],
                //ASIGNAR ACTIVIDADES
                asinaractividades_id: 0,
                actividad: '',
                idactividad: 0,
                idsubactividad: 0,
                idtipoactividad: 0,
                idempleado: 0,
                arrayAsignarActividades : [],
                arrayActividades : [],
                arrayGeneralidades : [],
                arrayAsignaciones : [],
                arrayUnidadAcademica : [],
                arrayCategoria : [],
                arrayAcronimo : [],
                ciclo: '',
                anio: '',
                inicio: '',
                fin: '',
                subactividad: '',
                tipoactividad: '',
                dia:'',
                //ASIGNAR ACTIVIDADES
                empleado_id: 0,
                empleado : {},
                nombre : '',
                profesion : '',
                id_acronimo : 0,
                direccion : '',
                genero : '',
                fecha_nacimiento : '',
                edad : '',
                telefono1 : '',
                telefono2 : '',
                celular : '',
                id_categoria : 0,
                dui : '',
                fechavencimiento : '',
                nit : '',
                afp : '',
                cargo : '',
                id_unidadacademica : 0,
                jefe : '',
                departamento : '',
                id_departamento : 0,
                id_municipio : '',
                municipio : '',
                desatestados : '',
                disatestados: [],
                id_user : 0,
                condicion : '',
                arrayEmpleados : [],
                arrayMunicipio : [],
                arrayDepartamento : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                errorEmpleado : 0,
                errorMostrarMsjEmpleado : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'empleados.nombre',
                buscar : '',
                formodal : 0,
                asignar : true,
                images : [],
                fotosviejas : [],
                fotosnuevas : [],
                fotos_modo : 0

            }

        },

        computed : {

            isActived : function(){
                return this.pagination.current_page;
            },

            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }

        },

        methods : {

            listarEmpleados(page, buscar, criterio){
                let me = this;
                var url = '/empleados?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEmpleados = respuesta.empleados.data;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            handleDateClick: function(arg) {
              alert('date click! ' + arg.dateStr)
            },

            calcularEdad(fecha) {

                let me = this;

                var hoy = new Date();
                var cumpleanos = new Date(me.fecha_nacimiento);
                var edad = hoy.getFullYear() - cumpleanos.getFullYear();
                var m = hoy.getMonth() - cumpleanos.getMonth();

                if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                    edad--;
                }

                me.edad = edad;

            },

            //ASIGNAR ACTIVIDADES
            selectGeneralidades(){
                let me = this;
                var url = '/generalidades';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.ciclo = respuesta.generalidades.data[0].ciclo;
                    me.anio = respuesta.generalidades.data[0].anio;
                    console.log(me);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectActividades(){
                let me = this;
                var url = '/asignaractividades/actividades';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayActividades = respuesta.actividades;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectActividad(idactividad){
                if(idactividad == "0"){
                    let me = this;
                    me.tipoactividad='';
                    me.subactividad='';
                }else {
                    let me = this;
                    var url = '/asignaractividades/selectActividad?id='+idactividad;
                    
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.selectTipoActividad(respuesta.actividad[0].idtipoactividad);
                        me.selectSubActividad(respuesta.actividad[0].idsubactividad);
                        me.actividad = respuesta.actividad[0].descripcion;
                    })
                    .catch(function (error) {
                        
                        console.log(error);
                    })
                }
                
            },

            selectAsignaciones(empleado_id){
                let me = this;
                var url = '/asignaractividades/selectAsignaciones?id='+empleado_id;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayAsignaciones=respuesta.asignaciones;
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectTipoActividad(idtipoactividad){
                let me = this;
                var url = '/asignaractividades/selectTipoActividad?id='+idtipoactividad;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.tipoactividad = respuesta.tipoactividades[0].descripcion;
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectSubActividad(idsubactividad){
                if(idsubactividad == null){
                    let me = this;
                    me.subactividad='N/A';
                    console.log(me);
                }else {
                    let me = this;
                    var url = '/asignaractividades/selectSubActividad?id='+idsubactividad;
                    
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.subactividad = respuesta.subactividades[0].descripcion;
                        console.log(me);
                    })
                    .catch(function (error) {
                        
                        console.log(error);
                    })
                }
            },
            
            registrarAsignacionesActividades(){
                let me = this;
                axios.post('/asignaractividades/registrar', {
                    'actividad': this.actividad,
                    'subactividad': this.subactividad,
                    'tipoactividad': this.tipoactividad,
                    'idempleado': this.empleado_id,
                    'idactividad': this.idactividad,
                    'ciclo': this.ciclo,
                    'anio': this.anio,
                    'dia': this.dia,
                    'inicio': this.inicio,
                    'fin': this.fin
                }).then(function (response) {
                    me.selectAsignaciones(me.empleado_id);
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'ACTIVIDADES ASIGNADAS',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarAsignacionesActividades(){
                let me = this;

                axios.put('/asignaractividades/actualizar', {
                    'id': this.asinaractividades_id,
                    'actividad': this.actividad,
                    'subactividad': this.subactividad,
                    'tipoactividad': this.tipoactividad,
                    'idempleado': this.idsubactividad,
                    'idactividad': this.idtipoactividad,
                    'ciclo': this.ciclo,
                    'anio': this.anio,
                    'inicio': this.inicio,
                    'fin': this.fin
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarActividades(1, '', 'actividades');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'ACTIVIDADES ACTUALIZADAS',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },
            //ASIGNAR ACTIVIDADES

            cambiarPagina(page, buscar, criterio){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarEmpleados(page, buscar, criterio);
            },

            vistaAsignarEmpleado(empleado){
                this.asignar = false;
                this.empleado = empleado;
                this.empleado_id = empleado.id;
                this.selectActividades();
                this.selectGeneralidades();
            },

            volverListaEmpleado(){
                this.empleado = {};
                this.empleado_id = 0;
                this.asignar = true;
            },

            registrarEmpleado(){

                if(this.validarEmpleado()){
                    
                    return;
                    
                }

                let me = this;

                axios.post('/empleados/registrar', {

                    'nombre': this.nombre,
                    'profesion': this.profesion,
                    'id_acronimo' : this.id_acronimo,
                    'direccion': this.direccion,
                    'edad' : this.edad,
                    'id_categoria' : this.id_categoria,
                    'genero': this.genero,
                    'fecha_nacimiento' : this.fecha_nacimiento,
                    'telefono1' : this.telefono1,
                    'telefono2' : this.telefono2,
                    'celular' : this.celular,
                    'dui' : this.dui,
                     'fechavencimiento':this.fechavencimiento,
                    'nit' : this.nit,
                    'afp' : this.afp,
                    'cargo' : this.cargo,
                    'id_unidadacademica' : this.id_unidadacademica,
                    'jefe' : this.jefe,
                    'id_municipio' : this.id_municipio,
                    'disatestados' : me.images,
                    'desatestados' : me.desatestados

                }).then(function (response) {

                    me.cerrarModal();
                    me.listarEmpleados(1, '', 'empleados.nombre');

                }).catch(function (error) {

                    console.log(error);

                });

            },

            validarEmpleado(){
                
                this.errorEmpleado = 0;
                this.errorMostrarMsjEmpleado = [];
                
                if(!this.nombre) this.errorMostrarMsjEmpleado.push("EL NOMBRE DEL EMPLEADO NO PUEDE IR VACÍO.");  
                if(!this.direccion) this.errorMostrarMsjEmpleado.push("LA DIRECCION DEL EMPLEADO NO PUEDE IR VACÍA."); 
                if(!this.id_municipio) this.errorMostrarMsjEmpleado.push("DEBE SELECCIONAR UN MUNICIPIO PARA EL EMPLEADO.");
                if(!this.genero) this.errorMostrarMsjEmpleado.push("DEBE SELECCIONAR UN GENERO PARA EL EMPLEADO.");
                 if(!this.fecha_nacimiento) this.errorMostrarMsjEmpleado.push("LA FECHA DE NACIMIENTO NO PUEDE IR VACIA.");
                if(!this.edad) this.errorMostrarMsjEmpleado.push("LA EDAD DEL EMPLEADO NO PUEDE IR VACIA.");
                if(!this.telefono1) this.errorMostrarMsjEmpleado.push("EL TELEFONO 1 NO PUEDE IR VACÍO.");
               
                if(!this.cargo) this.errorMostrarMsjEmpleado.push("EL CARGO DEL EMPLEADO NO PUEDE IR VACÍO.");
                if(!this.id_unidadacademica) this.errorMostrarMsjEmpleado.push("DEBE SELECCIONAR UNA UNIDAD ACADEMICA PARA EL EMPLEADO.");
                if(!this.id_acronimo) this.errorMostrarMsjEmpleado.push("DEBE SELECCIONAR UN ACRONIMO PARA EL EMPLEADO.");
                if(!this.id_categoria) this.errorMostrarMsjEmpleado.push("DEBE SELECCIONAR UNA CATEGORIA PARA EL EMPLEADO.");

                if(this.errorMostrarMsjEmpleado.length) this.errorEmpleado = 1;
                return this.errorEmpleado;

            },

            actualizarEmpleado(){

                let me = this;

                axios.put('/empleados/actualizar', {

                    'empleado_id' : this.empleado_id, 
                    'nombre': this.nombre,
                    'profesion': this.profesion,
                    'id_acronimo' : this.id_acronimo,
                    'direccion': this.direccion,
                    'edad' : this.edad,
                    'id_categoria' : this.id_categoria,
                    'genero': this.genero,
                    'fecha_nacimiento' : this.fecha_nacimiento,
                    'telefono1' : this.telefono1,
                    'telefono2' : this.telefono2,
                    'celular' : this.celular,
                    'dui' : this.dui,
                    'fechavencimiento':this.fechavencimiento,
                    'nit' : this.nit,
                    'afp' : this.afp,
                    'cargo' : this.cargo,
                    'id_unidadacademica' : this.id_unidadacademica,
                    'jefe' : this.jefe,
                    'id_municipio' : this.id_municipio,
                    'fotosviejas' : me.fotosviejas,
                    'fotosnuevas' : me.fotosnuevas,
                    'desatestados' : me.desatestados

                }).then(function (response) {

                    me.cerrarModal();
                    me.listarEmpleados(1, '', 'empleados.nombre');

                }).catch(function (error) {

                    console.log(error);

                });

            },

            selectUnidadAcademica(){

                let me = this;
                var url = '/unidadacademica/selectUnidadAcademica';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUnidadAcademica = respuesta.unidadesacademicas;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            obtenerInfoUnidadAcademica(r){
                
                let me = this;
                var url = '/unidadacademica/info?id_unidadacademica=' + r;
                
                axios.get(url).then(function (response) {

                    var respuesta = response.data;
                    me.jefe = respuesta.unidadacademica.jefe;
                    console.log(response);

                }).catch(function (error) {
                    
                    console.log(error);

                });

            },

            selectAcronimo(){

                let me = this;
                var url = '/acronimo/selectAcronimo';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayAcronimo = respuesta.acronimos;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectCategoria(){

                let me = this;
                var url = '/categoria/selectCategoria';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectDepartamento(){

                let me = this;
                var url = '/departamentos/selectDepartamento';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayDepartamento = respuesta.departamentos;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectMunicipio(id_departamento){

                let me = this;
                me.arrayMunicipio = [];
                if(me.tipoAccion != 2){
                    me.id_municipio = '';
                }
                var url = '/municipios/selectMunicipio?id_departamento=' + id_departamento;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMunicipio = respuesta.municipios;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            abrirModal(modelo, accion, data = []){

                let me = this;
                
                me.selectDepartamento();
                me.selectAcronimo();
                me.selectCategoria();
                me.selectUnidadAcademica();

                switch (modelo) {

                    case 'empleado':
                        
                        {

                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR EMPLEADO'
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                        var url = '/empleados/mostrar/' + data['id'];
                                
                                        axios.get(url).then(function (response) {

                                            var respuesta = response.data.empleado;

                                            me.empleado_id = respuesta.id;
                                            me.nombre = respuesta.nombre;
                                            me.id_acronimo = respuesta.idacronimo;
                                            me.profesion = respuesta.profesion;
                                            me.direccion = respuesta.direccion;
                                            me.genero = respuesta.genero;
                                            me.fecha_nacimiento = respuesta.fecha_nacimiento;
                                            me.edad = respuesta.edad;
                                            me.telefono1 = respuesta.telefono1;
                                            me.telefono2 = respuesta.telefono2;
                                            me.celular = respuesta.celular;
                                            me.id_categoria = respuesta.idcategoria;
                                            me.dui = respuesta.dui;
                                            me.fechavencimiento = respuesta.fechavencimiento;
                                            me.nit = respuesta.nit;
                                            me.afp = respuesta.afp;
                                            me.cargo = respuesta.cargo;
                                            me.id_unidadacademica = respuesta.idunidadacademica;
                                            me.jefe = respuesta.jefe;
                                            me.id_departamento = respuesta.iddepartamento;
                                            me.id_municipio = respuesta.idmunicipio;
                                            me.fotosviejas = respuesta.disatestados;
                                            me.modal = 1;
                                            me.tituloModal = 'ACTUALIZAR EMPLEADO';
                                            me.tipoAccion = 2;
                                            me.fotos_modo = 1;

                                            me.selectMunicipio(me.id_departamento);
                                            
                                            console.log(response);

                                        }).catch(function (error) {
                                            
                                            console.log(error);

                                        });

                                        break;
                                    }
                                case 'leer':
                                    {

                                        var url = '/empleados/mostrar/' + data['id'];
                                
                                        axios.get(url).then(function (response) {

                                            var respuesta = response.data.empleado;

                                            me.nombre = respuesta.nombre;
                                            me.id_acronimo = respuesta.acronimo;
                                            me.profesion = respuesta.profesion;
                                            me.direccion = respuesta.direccion;
                                            me.genero = respuesta.genero;
                                            me.fecha_nacimiento = respuesta.fecha_nacimiento;
                                            me.edad = respuesta.edad;
                                            me.telefono1 = respuesta.telefono1;
                                            me.telefono2 = respuesta.telefono2;
                                            me.celular = respuesta.celular;
                                            me.id_categoria = respuesta.categoria;
                                            me.dui = respuesta.dui;
                                            me.fechavencimiento = respuesta.fechavencimiento;
                                            me.nit = respuesta.nit;
                                            me.afp = respuesta.afp;
                                            me.cargo = respuesta.cargo;
                                            me.id_unidadacademica = respuesta.unidad;
                                            me.jefe = respuesta.jefe;
                                            me.id_departamento = respuesta.id_departamento;
                                            me.id_municipio = respuesta.id_municipio;
                                            me.fotosviejas = respuesta.disatestados;
                                            me.modal = 1;
                                            me.tituloModal = 'INFORMACIÓN DEL EMPLEADO';
                                            me.tipoAccion = 3;
                                            
                                            console.log(response);

                                        }).catch(function (error) {
                                            
                                            console.log(error);

                                        });

                                        break;
                                    }
                            
                            }
                        }
                        
                }
            },

            cerrarModal(){

                this.modal = 0;
                this.tipoAccion = 0;
                this.tituloModal = '';
                this.empleado_id = 0;
                this.nombre = '';
                this.id_acronimo = '';
                this.profesion = '';
                this.fecha_nacimiento = '';
                this.direccion = '';
                this.genero = '';
                this.edad = '';
                this.telefono1 = '';
                this.telefono2 = '';
                this.celular = '';
                this.id_categoria = '';
                this.dui = '';
                this.fechavencimiento ='',
                this.nit = '';
                this.afp = '';
                this.cargo = '';
                this.id_unidadacademica = '';
                this.jefe = '';
                this.departamento = '';
                this.municipio = '';
                this.id_departamento = '';
                this.id_municipio = '';
                this.disatestados = [];
                this.arrayDepartamento = [];
                this.arrayMunicipio = [];
                this.errorEmpleado = 0;
                this.errorMostrarMsjEmpleado = [];
                this.fotosviejas = [];
                this.fotosnuevas = [];
                this.fotos_modo = 0;

            },

            onFileChange(e) {
                // Obtener la informacion de las imagenes que selecciona el usuario en formato base64
                let vm = this;
                vm.images = [];
                let selectedFiles = e.target.files || e.dataTransfer.files;
                let file = document.querySelector('input[type=file]').files;
                for (let i = 0; i < selectedFiles.length; i++) {
                    
                    console.log(selectedFiles[i]);
                    vm.images.push(selectedFiles[i]);
                }
                for (let i = 0; i < vm.images.length; i++) {
                    
                    let reader = new FileReader();
                    
                    reader.onload = (e) => {
                        vm.$refs.image[i].src = reader.result;
                        vm.images[i] = e.target.result;
                        console.log(vm.$refs.image[i].src);
                    };
                    reader.readAsDataURL(file[i]);
                }
            },

            onFileChange2(e) {
                // Obtener la informacion de las imagenes que selecciona el usuario en formato base64
                let vm = this;
                vm.fotos_modo = 2;
                vm.fotosnuevas = [];
                let selectedFiles = e.target.files || e.dataTransfer.files;
                let file = document.querySelector('input[type=file]').files;
                for (let i = 0; i < selectedFiles.length; i++) {
                    
                    console.log(selectedFiles[i]);
                    vm.fotosnuevas.push(selectedFiles[i]);
                }
                for (let i = 0; i < vm.fotosnuevas.length; i++) {
                    
                    let reader = new FileReader();
                    
                    reader.onload = (e) => {
                        vm.$refs.fotosnuevas[i].src = reader.result;
                        vm.fotosnuevas[i] = e.target.result;
                        console.log(vm.$refs.fotosnuevas[i].src);
                    };
                    reader.readAsDataURL(file[i]);
                }
            },

            desactivarEmpleado(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    
                        title: 'ESTÁ SEGURO DE DESACTIVAR A ESTE EMPLEADO?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SÍ, DESACTÍVALO!',
                        cancelButtonText: 'NO, CANCELAR!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            let me = this;
                            axios.put('/empleados/desactivar', {
                                'id': id
                            }).then(function (response) {
                                me.listarEmpleados(1, '', 'empleados.nombre');
                                swalWithBootstrapButtons.fire(
                                    'DESACTIVADO!',
                                    'EL EMPLEADO HA SIDO DESACTIVADO.',
                                    'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            
                        }
                });
            },

            activarEmpleado(id){

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    
                        title: 'ESTÁ SEGURO DE ACTIVAR A ESTE EMPLEADO?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SÍ, ACTÍVALO!',
                        cancelButtonText: 'NO, CANCELAR!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            let me = this;
                            axios.put('/empleados/activar', {
                                'id': id
                            }).then(function (response) {
                                me.listarEmpleados(1, '', 'empleados.nombre');
                                swalWithBootstrapButtons.fire(
                                    'ACTIVADO!',
                                    'EL EMPLEADO HA SIDO ACTIVADO.',
                                    'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            
                        }
                });
            },

        },

        mounted() {
            //this.selectGeneralidades();
            //var week = new Date(0,0,0,0,0)
            //FullCalendar.setOption('locale', 'es');
            //FullCalendar.gotoDate(week)
            //FullCalendar.render();
            //this.selectEmpleado();
            this.listarEmpleados(1, this.buscar, this.criterio);

        }
    }

</script>

<style>

    .modal-content{
        width: 100% !important;
        position: fixed !important;
    }

    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #3c29297a !important;
        overflow-y: auto;
    }

    .div-error{
        display: flex;
        justify-content: center;
    }

    .text-error{
        color: red !important;
        font-weight: bold;
    }

    .pagination > li > a{
        background-color: white;
        color: #20a8d8 !important;
    }

    .pagination > li > a:focus,
    .pagination > li > a:hover,
    .pagination > li > span:focus,
    .pagination > li > span:hover{
        color: #20a8d8 !important;
        background-color: #eee !important;
        border-color: #ddd !important;
    }

    .pagination > .active > a{
        color: white !important;
        background-color: #20a8d8 !important;
        border: solid 1px #20a8d8 !important;
    }

    .pagination > .active > a:hover{
        background-color: #20a8d8 !important;
        border: solid 1px #20a8d8 !important;
    }

</style>