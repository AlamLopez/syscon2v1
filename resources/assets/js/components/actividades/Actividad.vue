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
                        <i class="fa fa-align-justify"></i> ACTIVIDADES
                        <button type="button" @click="abrirModal('actividades', 'registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;NUEVO
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="actividads.descripcion">DESCRIPCION</option>
                                      <option value="tipo_actividads.descripcion">TIPO ACTIVIDAD</option>
                                      <option value="sub_actividads.descripcion">SUB ACTIVIDAD</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarActividades(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">DESCRIPCION</th>
                                    <th style="text-align: center;">SUB ACTIVIDAD</th>
                                    <th style="text-align: center;">TIPO ACTIVIDAD</th>
                                    <th style="text-align: center;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="actividades in arrayActividades" :key="actividades.id">
                                    <td style="text-align: center;" v-text="actividades.descripcion"></td>
                                    <td style="text-align: center;">
                                        <div v-if="actividades.subactividad == null">
                                            <span class="badge badge-success">N/A</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger" v-text="actividades.subactividad"></span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;" v-text="actividades.tipoactividad"></td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('actividades', 'actualizar', actividades)" class="btn btn-warning btn-sm" title="EDITAR ACTIVIDAD">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;                                        
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
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" >DESCRIPCION (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="DESCRIPCION">
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" >SUBACTIVIDAD (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idsubactividad">
                                            <option value="0">SELECCIONE UNA SUBACTIVIDAD</option>
                                            <option value="null">NO TIENE</option>
                                            <option v-for="subactividad in arraySubActividades" :key="subactividad.id" :value="subactividad.id" v-text="subactividad.descripcion"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" >TIPO DE ACTIVIDAD (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idtipoactividad">
                                            <option value="0">SELECCIONE UN TIPO DE ACTIVIDAD</option>
                                            <option v-for="tipoactividad in arrayTipoActividades" :key="tipoactividad.id" :value="tipoactividad.id" v-text="tipoactividad.descripcion"></option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarActividades()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarActividades()" class="btn btn-primary">ACTUALIZAR</button>
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
    export default {

        data (){

            return {
                actividades_id: 0,
                descripcion: '',
                idsubactividad: 0,
                idtipoactividad: 0,
                arrayActividades : [],
                arraySubActividades : [],
                arrayTipoActividades : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'usuario',
                buscar : ''
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

            listarActividades(page, buscar, criterio){
                let me = this;
                var url = '/actividades?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayActividades = respuesta.actividades.data;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectSubActividad(){
                let me = this;
                var url = '/actividades/selectSubActividad';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySubActividades = respuesta.subactividades;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectTipoActividad(){
                let me = this;
                var url = '/actividades/selectTipoActividad';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoActividades = respuesta.tipoactividades;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            cambiarPagina(page, buscar, criterio){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarActividades(page, buscar, criterio);
            },

            registrarActividades(){
                let me = this;
                axios.post('/actividades/registrar', {
                    'descripcion': this.descripcion,
                    'idsubactividad': this.idsubactividad,
                    'idtipoactividad': this.idtipoactividad
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarActividades(1, '', 'usuario');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'ACTIVIDAD GUARDADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarActividades(){
                let me = this;

                axios.put('/actividades/actualizar', {
                    'id': this.actividades_id,
                    'descripcion': this.descripcion,
                    'idsubactividad': this.idsubactividad,
                    'idtipoactividad': this.idtipoactividad
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarActividades(1, '', 'actividades');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'ACTIVIDAD ACTUALIZADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            abrirModal(modelo, accion, data = []){

            	this.selectTipoActividad();
            	this.selectSubActividad();
                switch (modelo) {
                    case 'actividades':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR ACTIVIDAD';
                                        this.tipoAccion = 1;
                                        this.idsubactividad = 0;
                                        this.idtipoactividad = 0;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR ACTIVIDAD';
                                         this.tipoAccion = 2;
                                         this.actividades_id = data['id'];
                                         this.idsubactividad = data['idsubactividad'];
                                         this.idtipoactividad = data['idtipoactividad'];
                                         this.descripcion = data['descripcion'];
                                         break;
                                    }
                            
                            }
                        }
                        
                }
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.descripcion = '';
            }

        },

        mounted() {
            this.listarActividades(1, this.buscar, this.criterio);
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
</style>