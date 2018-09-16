
require('./bootstrap');

//window.Vue = require('vue'); no es necesario ya que lo importamos con el cdn
//Vue.component('example', require('./components/Example.vue'));

import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
//creacion de nuestras rutas con vue-router
const router = new Router({
	routes:[
		{
			path:'/',
			component:require('./components/home')
			//hecemos un require para usar un componente
			//{template:'<div>Probando mi ruta home</div>'}
		},
		{
			path:'/contacto',
			component:require('./components/contacto')
			//{template:'<div>Probando mi ruta contacto</div>'}

		},
		{
			path:'/nosotros',
			//component:require('./components/')
			//{template:'<div>Probando mi ruta nosotros</div>'}

		},
	],
	//esto agrega la clase active al link-router en el que estamos
	linkExactActiveClass:'active'
});

//despues de definir nuestras rutas debemos pasarlas a nuestra instancia de vue
const app = new Vue({
    el: '#app',
    router
});
