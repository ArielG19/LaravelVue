<template>
    <div class="container">
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">Nuevo producto</a>
        <form action="POST" v-on:submit.prevent="crearProducto">
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
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" class="form-control" v-model="nuevoProducto">
                                    </div>
                                
                                </div>
                                  <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" value="Guardar" class="btn btn-primary">Save changes</button>
                                  </div>
                            </div>
                          </div>
                        </div>
                    </form>

        <div class="row">
            <div class="col-md-4">
                <div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="product in products">
                          <th scope="row">{{ product.id }}</th>
                          <td>{{ product.name }}</td>
                          <td>Otto</td>
                        </tr>
                      </tbody>
                    </table>

                    
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
      export default{
        data:function(){
            return{
                products:[],
                nuevoProducto:''

            }
        },
        mounted(){
            //mouted esta siendo usado como created
            this.getProduct();
        },
        methods:{
            getProduct(){
                //console.log('probando');
                var url = 'product';
                axios.get(url).then(response => {
                    //agregamos.task.data para poder acceder a todos los registro y hacer la paginacion
                    this.products = response.data.data
                    //console.log(response.data.data);
                    //this.pagination = response.data.pagination
                })
                .catch(error =>{
                    console.log(error);
                });

            },
            crearProducto(){
                var urlCrear = 'product';
                axios.post(urlCrear,{name:this.nuevoProducto}).then(response => {
                    //para que se actualice la vista despues de eliminar
                    this.getProduct();
                    //despues dejamos vacia la caja de texto y los errores
                    this.nuevoProducto ='';
                    //ocultamos el modal
                    $('#create').modal('hide');
                    $('.modal-backdrop.show').hide();
                    toastr.success('Producto creada');             
                }).catch(error => {
                    this.errors = error.response.data
                });

            }
        }
    }

</script>
