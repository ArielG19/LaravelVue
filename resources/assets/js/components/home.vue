<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-primary" role="alert">
                  A simple primary alert—check it out!
                </div>
                <div class="alert alert-secondary" role="alert">
                  A simple secondary alert—check it out!
                </div>
                <div class="alert alert-success" role="alert">
                  A simple success alert—check it out!
                </div>
                <div class="alert alert-danger" role="alert">
                  A simple danger alert—check it out!
                </div>
                <div class="alert alert-warning" role="alert">
                  A simple warning alert—check it out!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        //este script es para este componente
        //el siguiente metodo es usado para montar y renderizar 
        prueba:function(){
            console.log('probando');
        }
    }
</script>
