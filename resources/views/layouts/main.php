<?php

function head($ua=null){
    !is_null($ua) ? $ua->sessionValidate() : null ;

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/ejercicioT/resources/css/bootstrap.min.css" rel="stylesheet" >   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <style>
            body {
                font-family: 'Lato';
                margin: 0;
            }
        </style>
        <title>Blog X</title>
    </head>
        <body id="app" class="container-fluid p-0">
            <header class="row bg-light text-dark m-0">
                <div class="col-9">
                    <h1 class="titulo ml-3 mt-2 font-weight-bolder">Blog Excepcional</h1>
                </div>
                <div class="col-3 text-end">
                    <img src="/resources/images/ppw.png" style="height:60px;" alt="" srcset="">
                </div>
            </header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light"  style="box-shadow: 0 10px 10px #DDD">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">BlogX</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">                    
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/ejercicioT/resources/views/home.php">Inicio <i class="bi bi-house-fill"></i></a>
                            </li>
                            <?php if(!is_null($ua) && $ua->sv){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="app.view('myposts')">Mis publicaciones <i class="bi bi-clock"></i></a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Publicar <i class="bi bi-pencil-square"></i></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <?php if(is_null($ua) || !$ua->sv){ ?>
                                    <button type="button" onclick="app.view('inisesion')" class="nav-link btn btn-link">Iniciar sesión</button>
                                <?php }else{ ?>
                                    <a href="#" role="button" data-toggle="dropdown" id="navbarDropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                                        <?=$ua->name?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><button type="button" onclick="app.view('logout')" class="dropdown-item btn btn-link" >Cerrar sesión</button></li>
                                        <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                    </ul>                                                                
                                <?php } ?>
                            </li>
                        </ul>   
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" id="buscar-palabra" placeholder="Buscar en publicaciones" aria-label="Search">
                            <button class="btn btn-outline-success" type="button" onclick="app.buscarPalabra()"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </div>
            </nav>

<?php
}

function scripts($script=""){?>
    <script src="/ejercicioT/resources/js/jquery.min.js"></script>
    <script src="/ejercicioT/resources/js/bootstrap.min.js"></script>
    <script src="/ejercicioT/resources/js/popper.min.js"></script>
    <script src="/ejercicioT/resources/js/app.js"></script>
<?php
    if($script!=""){
        echo '<script src="/ejercicioT/resources/js/' . $script . '"></script>';
    }
}

function foot() {
?>
</body>
</html>

<?php }