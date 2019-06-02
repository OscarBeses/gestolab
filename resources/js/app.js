
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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

$(document).ready(function(){

    /**
     * Al seleccionar un producto se realiza una petición ajax 
     * para averiguar el precio y colocarlo en el campo importe
     */
    $("select#prod").change(function(e) {
        var idProducto = e.target.value;
        
        // AJAX
        $.get('/ajax-damePrecioProd?prod_id='+idProducto, function(data){
            var importeProd = data[0].prd_importe
            $("input#imp").val(importeProd);
        });

    });
    
    /**
     * Tras emitir ocultamos los botones de guardar albaran, añadir trabajo y modificar o borrar trabajos
     */
    function trasEmitir() {
        $("#divGuardar").remove();
        $("#divNuevoTrabajo").remove();
        $(".tdBtnEditarBorrar").remove();
    }

});

