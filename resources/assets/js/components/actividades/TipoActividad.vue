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
                        <i class="fa fa-align-justify"></i> TIPO DE ACTIVIDADES
                        <button type="button" @click="abrirModal('tipoactividad', 'registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;NUEVO
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">DESCRIPCIÓN</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarTipoActividades(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">DESCRIPCIÓN</th>
                                    <th style="text-align: center;">DOCENTE</th>
                                    <th style="text-align: center;">PERMANENTE</th>
                                    <th style="text-align: center;">ADMINISTRATIVO</th>
                                    <th style="text-align: center;">TECNICO</th>
                                    <th style="text-align: center;">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tipoactividad in arrayTipoActividad" :key="tipoactividad.id">
                                    <td style="text-align: center;" v-text="tipoactividad.descripcion"></td>
                                    <td style="text-align: center;">
                                        <div v-if="tipoactividad.esdocente">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div v-if="tipoactividad.espermanente">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div v-if="tipoactividad.esadministrativo">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div v-if="tipoactividad.estecnico">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('tipoactividad', 'actualizar', tipoactividad)" class="btn btn-warning btn-sm" title="EDITAR TIPO DE ACTIVIDAD">
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
                                    <label class="col-md-3 form-control-label" for="text-input">DESCRIPCION (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="DESCRIPCION">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group row">
                                <label class="col-md-3 col-form-label"><b>APLICA:</b></label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-group row">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" id="inline-checkbox1" v-model="esdocente" type="checkbox" value="check1">
                                        <label class="form-check-label" for="inline-checkbox1">DOCENTE</label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" id="inline-checkbox2" v-model="espermanente" type="checkbox" value="check2">
                                        <label class="form-check-label" for="inline-checkbox2">PERMANENTE</label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" id="inline-checkbox3" v-model="esadministrativo" type="checkbox" value="check3">
                                        <label class="form-check-label" for="inline-checkbox3">ADMINISTRATIVO</label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" id="inline-checkbox3" v-model="estecnico" type="checkbox" value="check3">
                                        <label class="form-check-label" for="inline-checkbox3">TECNICO</label>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarTipoActividad()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarTipoActividad()" class="btn btn-primary">ACTUALIZAR</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </main>
</template>

<script>
    export default {
        data (){
            return {
                tipoactividad_id: 0,
                descripcion : '',
                esdocente : false,
                espermanente : false,
                esadministrativo : false,
                estecnico : false,
                arrayTipoActividad : [],
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
                criterio : 'nombre',
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
            listarTipoActividades(page, buscar, criterio){
                let me = this;
                var url = '/tipoactividades?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoActividad = respuesta.tipoactividades.data;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },
            cambiarPagina(page, buscar, criterio){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarTipoActividades(page, buscar, criterio);
            },
            registrarTipoActividad(){
                let me = this;
                axios.post('/tipoactividades/registrar', {
                    'descripcion': this.descripcion,
                    'esdocente': this.esdocente,
                    'espermanente' : this.espermanente,
                    'esadministrativo': this.esadministrativo,
                    'estecnico': this.estecnico
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipoActividades(1, '', 'tipoactividad');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'TIPO DE ACTIVIDAD GUARDADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarTipoActividad(){
                let me = this;

                axios.put('/tipoactividades/actualizar', {
                    'id': this.tipoactividad_id,
                    'descripcion': this.descripcion,
                    'esdocente': this.esdocente,
                    'espermanente' : this.espermanente,
                    'esadministrativo': this.esadministrativo,
                    'estecnico': this.estecnico
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipoActividades(1, '', 'tipoactividades');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'TIPO DE ACTIVIDAD ACTUALIZADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            abrirModal(modelo, accion, data = []){
                switch (modelo) {
                    case 'tipoactividad':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR TIPO DE ACTIVIDAD'
                                        this.descripcion = '';
                                        this.esdocente = false;
                                        this.espermanente = false;
                                        this.esadministrativo = false;
                                        this.estecnico = false;
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR TIPO DE ACTIVIDAD';
                                         this.tipoAccion = 2;
                                         this.descripcion = data['descripcion'];
                                         this.esdocente = data['esdocente'];
                                         this.espermanente = data['espermanente'];
                                         this.esadministrativo = data['esadministrativo'];
                                         this.estecnico = data['estecnico'];
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
                this.esdocente = false;
                this.espermanente = false;
                this.esadministrativo = false;
                this.estecnico = false;
            }
        },
        mounted() {
            this.listarTipoActividades(1, this.buscar, this.criterio);
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