
require('./bootstrap');


import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
//creacion de nuestras rutas con vue-router
const router = new Router({
	routes:[
		{
			//asignarle un nombre a la ruta en vue-router
			//name:'home',
			path:'/',
			//component:require('./components/home')
			//hecemos un require para usar un componente
			component:{template:'<div>Probando mi ruta home</div>'}
		},
		{
			path:'/publicaciones',
			component:require('./components/post')
			
		},
		{
			path:'/productos',
			component:require('./components/product')
		},
		{
			//ruta 404, con el * indicamos que cuando busque una ruta no definida ira al 404
			//siempre colocarla al final por que sobreescibe
			path:'*',
			component:require('./components/404')
		}
	],
	//esto agrega la clase active al link-router en el que estamos
	linkExactActiveClass:'active',
	mode:'history' //para quitar el # en la ruta
});

//despues de definir nuestras rutas debemos pasarlas a nuestra instancia de vue
const app = new Vue({
    el: '#app',
    router
});
