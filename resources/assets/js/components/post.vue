<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div v-for="post in posts">
                    <div class="alert alert-success" role="alert">
                        {{ post.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //este script es para este componente
        //el siguiente metodo es usado para montar y renderizar. Tiene que se mounted el metodo 

    export default{
        data:function(){
            return{
                posts:[]

            }
        },
        mounted(){
            //mouted esta siendo usado como created
            this.getPost();
        },
        methods:{
            getPost(){
                //console.log('probando');
                var url = 'post';
                axios.get(url).then(response => {
                    //agregamos.task.data para poder acceder a todos los registro y hacer la paginacion
                    this.posts = response.data.data
                    //console.log(response.data.data);
                    //this.pagination = response.data.pagination
                })
                .catch(error =>{
                    console.log(error);
                });

            }
        }
    }
</script>
