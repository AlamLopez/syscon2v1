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
                        <i class="fa fa-align-justify"></i> TIPOS DE CONTRATOS
                        <button type="button" @click="abrirModal('tipocontratos', 'registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;NUEVO
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">TIPO DE CONTRATO</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarTipoContratos(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                </div>
                            </div>
                               <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">HORAS MAXIMAS</option>
                                    </select>
                                    <input type="number" v-model="buscar" @keyup="listarTipoContratos(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">TIPO CONTRATO</th>
                                    <th style="text-align: center;">HORAS MAXIMAS</th>

                                    <th style="text-align: center;">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tipocontratos in arrayTipoContratos" :key="tipocontratos.id">
                                    <td style="text-align: center;" v-text="tipocontratos.descripcion"></td>
                                    <td style="text-align: center;" v-text="tipocontratos.horasemana"></td>
                                        <button type="button" @click="abrirModal('tipocontratos', 'actualizar', tipocontratos)" class="btn btn-warning btn-sm" title="EDITAR SUB ACTIVIDAD">
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
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">HORAS MAXIMAS (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="horasemana" class="form-control" placeholder="HORAS MAXIMAS ">
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarTipoContratos()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarTipoContratos()" class="btn btn-primary">ACTUALIZAR</button>
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
                id: 0,
                descripcion : '',
                arrayTipoContratos : [],
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
            listarTipoContratos(page, buscar, criterio){
                let me = this;
                var url = '/tipocontratos?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoContratos = respuesta.tipocontratos.data;
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
                me.listarTipoContratos(page, buscar, criterio);
            },
            registrarTipoContratos(){
                let me = this;
                axios.post('/tipocontratos/registrar', {
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipoContratos(1, '', 'tipocontratos');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'TIPO CONTRATO GUARDADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarTipoContratos(){
                let me = this;

                axios.put('/tipocontratos/actualizar', {
                    'id': this.id,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipoContratos(1, '', 'tipocontratos');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'TIPO CONTRATOS ACTUALIZADA',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            abrirModal(modelo, accion, data = []){
                switch (modelo) {
                    case 'tipocontratos':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR TIPO CONTRATO'
                                        this.descripcion = '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR TIPO CONTRATO';
                                         this.tipoAccion = 2;
                                         this.id = data['id'];
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
            this.listarTipoContratos(1, this.buscar, this.criterio);
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