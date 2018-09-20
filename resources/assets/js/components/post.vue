<template>
      <div class="row">
            <div class="col-md-6">
                        <div class="col-md-4" v-if="image">
                            <div class="form-group">
                              <img :src="image" class="img-responsive" height="70" width="90">
                            </div>  
                        </div>
                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">Nuevo imagen</a>
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
                                                             <div class="col-md-8">                           
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
                image:'',
                newTitle:''
            }
        },
        methods: {
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
                    this.image ='';
                    this.newTitle ='';                
                    //ocultamos el modal
                    $('#create').modal('hide');
                    $('.modal-backdrop.show').hide();
                    toastr.success('Datos Guardados');
                                          
                }).catch(error => {
                    this.errors = error.response.data
                });
            }
            
        }
    }
    
</script>
