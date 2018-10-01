<template>
      <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <br><br>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <input name="title" type="text" placeholder="Buscar" class="form-control" v-model="title">
                            </li>
                        </ul>     
                            <br>
                            <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#create">Nuevo imagen</a>

                           
                             <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">id</th>
                                  <th scope="col">Titulo</th>
                                  <th scope="col">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="newDatos in searchUser">
                                  <th scope="row">{{ newDatos.id }}</th>
                                  <td>{{ newDatos.title }}</td>
                                  <td>
                                    <img :src="'/images/' + newDatos.image" class="img-responsive" height="70" width="90">
                                  </td>
                                  
                                </tr>
                            </tbody>
                        </table>

                        <ul class="pagination">
                            <li v-if="pagination.current_page > 1" class="page-item">
                              <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                <span>Atras</span>
                              </a>
                            </li>

                            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']" class="page-item">
                              <a class="page-link" href="#" @click.prevent="changePage(page)">
                                {{ page }}
                              </a>
                            </li>

                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                              <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                <span>Siguiente</span>
                              </a>
                            </li>
                      </ul>


                          

                        <form action="POST" v-on:submit.prevent="uploadImage">  
                                <div class="modal fade" id="create" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                                <h5 class="modal-title">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                        <div class="modal-body">
                                                             <div>   
                                                                <div class="col-md-4" v-if="image">
                                                                <div class="form-group">
                                                                  <img :src="image" class="img-responsive" height="70" width="90">
                                                                </div>  
                                                            </div>
                        
                                                                <div class="form-group">
                                                                    <label for="">Imagen</label>    
                                                                    <input type="file" v-on:change="ImageChange" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title">Titulo</label>
                                                                  <input type="text" name="title" v-model="newTitle" class="form-control">
                                                                </div>                                 
                                                            </div>                                                 
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" value="Guardar" class="btn btn-primary">Save image</button>
                                                        </div>
                                                </div>
                                          </div>
                                    </div>
                        </form>

                       
            </div> 
        </div>
</template>
<script>
    export default {
        data(){
            return {
                Datos:[],
                image:'',
                newTitle:'',
                title:'', //agregamos la propiedad por la que queremos filtrar
                offset:3,
                pagination:{
                            'total': 0,
                            'current_page': 0,
                            'per_page': 0,
                            'last_page': 0,
                            'from': 0,
                            'to': 0
                }
            }
        },
        mounted(){
            //mouted esta siendo usado como created
            this.getPost();
        },
        computed:{
                //funcion para filtrar
                searchUser: function () {
                    //return this.Datos.filter(newDatos => newDatos.title.includes(this.title));
                    return this.Datos.filter(newDatos => {
                    return newDatos.title.toLowerCase().includes(this.title.toLowerCase())
                  })
                   
                },
                isActived: function() {
                    return this.pagination.current_page;
                },
                pagesNumber: function() {
                    if(!this.pagination.to){
                        return [];
                    }

                    var from = this.pagination.current_page - this.offset; 
                    if(from < 1){
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
        watch:{
            //Con watch observa la fincion y ejecuta
            //
            title: function(){
                this.buscarTitle();
            }
        },
        methods: {
            //con debounce lo que hacemos es dar un tiempo de espera para que la funcion busque dentro de los datos.
            buscarTitle: _.debounce(
                function(){
                    this.getPost();
                },
                1000
            ),
            getPost(page){
                //ademas del parametro page q pagina, pasamos title para buscar
                var url = 'post?page=' + page + '&title=' + this.title;
                axios.get(url).then(response => {
                    this.Datos = response.data.Datos.data
                    this.pagination = response.data.pagination
                    //console.log(response.data.data);
                    
                })
                .catch(error =>{
                    console.log(error);
                });
            },
            //metodo para optener la imagen
            ImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                var url = 'post';
                axios.post(url,{image: this.image,title:this.newTitle})
                .then(response => {
                    this.getPost();
                    this.image ='';
                    this.newTitle ='';                
                    //ocultamos el modal
                    $('#create').modal('hide');
                    $('.modal-backdrop.show').hide();
                    toastr.success('Datos Guardados');
                                          
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            //metodo para cambiar de pagina 
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getPost(page);
            } 
        }
    }
    
</script>
