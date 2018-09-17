<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token">

        <title>Laravel y Vue-router</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/cdn/bootstrap.css">
        <!--Toas css-->
        <link rel="stylesheet" href="/cdn/toastr.css">

    </head>
    <body>
        <div id="app">
              <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="#">Navbar w/ text</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <router-link to="/" params="" class="nav-link">Home 
                            <span class="sr-only">(current)</span>
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link to="/publicaciones" params="" class="nav-link">
                            Publicaciones
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link to="/productos" params="" class="nav-link">
                            Productos
                          </router-link>

                        </li>
                      </ul>
                      <span class="navbar-text">
                        Navbar text with an inline element
                      </span>
                    </div>
              </nav>
        
              <router-view></router-view>
              <div id="crud" class="container">
                  <div>
                  @yield('content')
                  </div>
              </div>
        </div>
        <!--vue no es necesario ya que al tener instalado vue con npm seria como tener dos cdn y marca error en consola
        <script src="cdn/vue.js"></script>-->
        <!-- axios-->
        <script src="/cdn/axios.js"></script>
        
        <script src="/cdn/jquery.js"></script>

        <script src="/cdn/bootstrap.js"></script>
        <script src="/cdn/toastr.js"></script>
        <script src="{{asset('js/app.js')}}"></script>
       </body>
</html>
