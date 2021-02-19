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
                        <i class="fa fa-align-justify"></i> ASIGNAR ACTIVIDADES
                    </div>
                    
                    <div class="card-body">
                        <h2 class="m-0 text-dark" v-text="'Asignación de actividades: '+generalidades.ciclo+' - '+generalidades.anio"> </h2>
                        <h1 class="m-0 text-dark" v-text="'Empleado: '+empleado.dui+' - '+empleado.nombre"></h1>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" >ACTIVIDAD (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idactividad">
                                            <option value="0">SELECCIONE UNA ACTIVIDAD</option>
                                            <option v-for="actividad in arrayActividades" :key="actividad.id" :value="actividad.id" v-text="actividad.descripcion"></option>
                                        </select>
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
                        <label class="col-md-3 form-control-label" >HORA INICIO (*)</label>
                                    <div class="col-md-3">
                                        <input type="time" v-model="inicio">
                                    </div>
                        <label class="col-md-3 form-control-label" >HORA FIN (*)</label>
                                    <div class="col-md-3">
                                         <input type="time" v-model="fin">
                                    </div>
                        <label class="col-md-3 form-control-label" >SUBACTIVIDAD (*)</label>
                                    <div class="col-md-3">
                                         <input type="time" v.model="subactividad">
                                    </div>
                        <label class="col-md-3 form-control-label" >TIPOACTIVIDAD (*)</label>
                                    <div class="col-md-3">
                                         <input type="time" v.model="tipoactividad">
                                    </div>
                        <label class="col-md-3 form-control-label" >AGREGAR (*)</label>
                                    <div class="col-md-3">
                                         <input type="button" onclick="add()" value="Agregar">
                                    </div>
                    <div id="calendar">
                    </div>
                    </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            
            <!--Fin del modal-->
        </main>
</template>

<script>
    var calendar
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');
        var week = new Date(0,0,0,0,0)
        calendar = new FullCalendar.Calendar(calendarEl, {
            eventClick: function(info) {
            info.event.remove();
    // change the border color just for fun
            info.el.style.borderColor = 'red';
            },
            plugins: [ 'timeGrid', 'bootstrap' ],
            defaultView: 'timeGridWeek',
            themeSystem: 'bootstrap',
            allDaySlot: false,
            columnHeaderFormat: {weekday: 'long'},

            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                hour12: false
            },
            header: {
                left:   '',
                center: '',
                right:  ''
            },
            slotDuration: "01:00:00",
            events: [
                /*@foreach($horas as $hora)
                {
                    start: new Date(0,0,{{$hora->dia}},{{Date('H',strtotime($hora->start))}},{{Date('i',strtotime($hora->start))}}),
                    end:new Date(0,0,{{$hora->dia}},{{Date('H',strtotime($hora->end))}},{{Date('i',strtotime($hora->end))}}),
                    title:{{$hora->actividad}},
                },
                @endforeach*/
            ]
        });

        calendar.setOption('locale', 'es');
        calendar.gotoDate(week)
        calendar.render();
    });
    function add() {
        act = (document.getElementById("actividad").value + '-' + document.getElementById("subactividad").value + '-' + document.getElementById("tipoactividad").value  ).split(":");
        start = document.getElementById("inicio").value.split(":");
        end = document.getElementById("fin").value.split(":");
        dia = document.getElementById("dia").value;

        calendar.addEvent({start: new Date(0,0,dia,start[0],start[1]), end: new Date(0,0,dia,end[0],end[1]), title: act});
    }

    function get(){
        eventos = calendar.getEvents();
        ev = eventos[1];
        console.log(ev.start.toLocaleTimeString());
    }

    </script>

    <script>
    export default {
        data (){

            return {
                asinaractividades_id: 0,
                actividad: '',
                idactividad: 0,
                idempleado: 0,
                arrayAsignarActividades : [],
                arrayActividades : [],
                arrayActividades : [],
                ciclo: '',
                anio: '',
                subactividad: '',
                tipoactividad: '',
                dia:'',
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

        methods : {

            selectGeneralidades(){
                let me = this;
                var url = '/generalidades';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayGeneralidades = respuesta.generalidades;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectActividades(){
                let me = this;
                var url = '//asignaractividades/actividades';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayActividades = respuesta.actividades;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },
            
            
            registrarAsignacionesActividades(){
                let me = this;
                axios.post('/asignaractividades/registrar', {
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
                    me.listarActividades(1, '', 'usuario');
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

        mounted() {
            this.selectEmpleado();
        }
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