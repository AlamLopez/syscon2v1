/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('rol', require('./components/acceso/Rol.vue').default);
Vue.component('usuario', require('./components/acceso/User.vue').default);
Vue.component('empleados', require('./components/empleados/Empleado.vue').default);
Vue.component('generalidades', require('./components/generalidades/Generalidades.vue').default);
Vue.component('tipoactividades', require('./components/actividades/TipoActividad.vue').default);
Vue.component('subactividades', require('./components/actividades/SubActividad.vue').default);
Vue.component('actividades', require('./components/actividades/Actividad.vue').default);
Vue.component('asignaractividades', require('./components/asignaractividades/AsignarActividad.vue').default);
Vue.component('tipocontratos', require('./components/contrato/TipoContrato.vue').default);
Vue.component('controlhorarios', require('./components/acceso/ControlHorario.vue').default);
Vue.component('acronimo', require('./components/actividades/Acronimo.vue').default);
Vue.component('categoria', require('./components/actividades/Categoria.vue').default);
Vue.component('unidadacademica', require('./components/actividades/UnidadAcademica.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data : {
        menu : 0
    }
});
