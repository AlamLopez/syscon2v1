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
                   
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="empresa">EMPRESA</option>
                                      <option value="rector">RECTOR</option>
                                      <option value="vicerector">VICERECTOR</option>
                                      <option value="facultad">FACULTAD</option>
                                        <option value="decano">DECANO</option>
                                      <option value="vicedecano">VICEDECANO</option>
                                      <option value="ciclo">CICLO</option>
                                      <option value="anio">AÑO</option>
                                       <option value="inicio">INICIO PERIODO</option>
                                        <option value="final">FINAL PERIODO</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarGeneralidades(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                    <button type="submit" @click="listarGeneralidades(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">OPCIONES</th>
                                    <th style="text-align: center;">EMPRESA</th>
                                    <th style="text-align: center;">RECTOR</th>
                                    <th style="text-align: center;">VICERECTOR</th>
                                    <th style="text-align: center;">FACULTAD</th>
                                    <th style="text-align: center;">DECANO</th>
                                      <th style="text-align: center;">VICEDECANO</th>
                                    <th style="text-align: center;">CICLO</th>
                                    <th style="text-align: center;">AÑO</th>
                                    <th style="text-align: center;">FECHA INCIO</th>
                                     <th style="text-align: center;">FECHA FINAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="generalidades in arrayGeneralidades" :key="generalidades.id">
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('generalidades', 'actualizar', generalidades)" class="btn btn-warning btn-sm" title="EDITAR GENERALIDADES">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td style="text-align: center;" v-text="generalidades.empresa"></td>
                                    <td style="text-align: center;" v-text="generalidades.rector"></td>
                                    <td style="text-align: center;" v-text="generalidades.vicerector"></td>
                                    <td style="text-align: center;" v-text="generalidades.facultad"></td>
                                     <td style="text-align: center;" v-text="generalidades.decano"></td>
                                    <td style="text-align: center;" v-text="generalidades.vicedecano"></td>
                                     <td style="text-align: center;" v-text="generalidades.ciclo"></td>
                                      <td style="text-align: center;" v-text="generalidades.anio"></td>
                                       <td style="text-align: center;" v-text="generalidades.inicio"></td>
                                        <td style="text-align: center;" v-text="generalidades.final"></td>
                                   
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
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" >
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
                                    <label class="col-md-3 form-control-label" for="text-input">NOMBRE DEL RECTOR</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="rector" class="form-control" placeholder="NOMBRE DEL RECTOR">
                                    </div>
                                </div>
                                   <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">NOMBRE DEL VICERECTOR</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="vicerector" class="form-control" placeholder="NOMBRE DEL VICERECTOR">
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">NOMBRE DEL DECANO</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="decano" class="form-control" placeholder="NOMBRE DEL DECANO">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">NOMBRE DEL VICEDECANO</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="vicedecano" class="form-control" placeholder="NOMBRE DEL VICEDECANO">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">CICLO</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="ciclo">
                                            <option value="CICLO I">CICLO I</option>
                                            <option value="CICLO II">CICLO II</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">AÑO</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="anio">
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                             <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                             <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                             <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                             <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">PERIODO INICIAL</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="inicio" class="form-control" placeholder="PERIODO INICIAL">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">PERIODO FINAL</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="final" class="form-control" placeholder="PERIODO FINAL">
                                    </div>
                                </div>
                                
                              
                            </form>
                              </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarGeneralidades()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarGeneralidades()" class="btn btn-primary">ACTUALIZAR</button>
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
                id: 0,
                empresa : '',
                rector : '',
                vicerector : '',
                facultad : '',
                decano : '',
                vicedecano : '',
                ciclo : '',
                anio : '',
                inicio : '',
                final : '',
                arrayGeneralidades : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                errorGeneralidades : 0,
                errorMostrarMsjGeneralidades : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'generalidades',
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

            listarGeneralidades(page, buscar, criterio){
                let me = this;
                var url = '/generalidades?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayGeneralidades = respuesta.generalidades.data;
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
                me.listarUsuario(page, buscar, criterio);
            },



            registrarGeneralidades(){
                let me = this;
                axios.post('/generalidades/registrar', {
                    'empresa' : this.empresa,
                    'rector' : this.rector,
                    'vicerector' : this.vecerector,
                    'facultad' : this.facultad,
                    'decano' : this.decano,
                    'vicedecano' : this.vicedecano,
                    'ciclo' : this.ciclo,
                    'anio' : this.anio,
                    'inicio' : this.inicio,
                    'final' : this.final
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarGeneralidades(1, '', 'generalidades');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'GENERALIDADES ACTUALIZADO',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarGeneralidades(){

                let me = this;

                axios.put('/generalidades/actualizar', {
                    'id': this.id,
                    'empresa' : this.empresa,
                    'rector' : this.rector,
                    'vicerector' : this.vicerector,
                    'facultad' : this.facultad,
                    'decano' : this.decano,
                    'vicedecano' : this.vicedecano,
                    'ciclo' : this.ciclo,
                    'anio' : this.anio,
                    'inicio' : this.inicio,
                    'final' : this.final
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarGeneralidades(1, '', 'generalidades');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'GENERALIDADES ACTUALIZADO',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

        

            abrirModal(modelo, accion, data = []){
                switch (modelo) {
                    case 'generalidades':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR GENERALIDADES'
                                        
                                        this.empresa= '';
                                        this.rector= '';
                                        this.vicerector= '';
                                        this.facultad= '';
                                        this.decano= '';
                                        this.vicedecano= '';
                                        this.ciclo= '';
                                        this.anio= '';
                                        this.inicio= '';
                                        this.final= '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR GENERALIDADES';
                                         this.tipoAccion = 2;
                                         this.id=data['id'];      
                                         this.empresa= data['empresa'];
                                        this.rector= data['rector'];
                                        this.vicerector= data['vicerector'];
                                        this.facultad= data['facultad'];
                                        this.decano= data['decano'];
                                        this.vicedecano= data['vicedecano'];
                                        this.ciclo= data['ciclo'];
                                        this.anio= data['anio'];
                                        this.inicio= data['inicio'];
                                        this.final= data['final'];
                                         break;
                                    }
                            
                            }
                        }
                        
                }
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.empresa= '';
                this.rector= '';
                this.vicerector= '';
                this.facultad= '';
                this.decano= '';
                this.vicedecano= '';
                 this.ciclo= '';
                this.anio= '';
                this.inicio= '';
                this.final= '';
                this.errorGeneralidades = 0;
                this.errorMostrarMsjGeneralidades = [];
            }

        },

        mounted() {
            this.listarGeneralidades(1, this.buscar, this.criterio);
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