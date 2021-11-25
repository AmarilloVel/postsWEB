<?php

include "../layouts/main.php";

head();

?>

<div class="container">

    <div class="card mx-auto mt-5 w-50">
        <div class="card-header">
            Inicio de sesión
        </div>
        <div class="card-body">
            <form action="" id="inisesionform">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="passwd">Contraseña</label>
                    <input type="password" name="passwd" id="passwd" class="form-control">
                </div>
                <small id="error" class="form-text text-danger d-none mb-2">Los datos de inicio de sesión son incorrectos</small>
                <br>
                <button type="submit" class="btn btn-primary mt-3">Iniciar</button>
            </form>
        </div>    
    </div>

</div>

<?php scripts(); ?>

<script type="text/javascript">

    $(function(){

        const isf = $("#inisesionform");
        isf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();

            const datos = new FormData();
            datos.append("email",$("#email").val());
            datos.append("passwd",$("#passwd").val());
            datos.append("login","");

            fetch(app.routes.login,{
                    method : "POST",
                    body : datos})
                .then( response => response.json())
                .then( resp => {
                    console.log("Resultado: ",resp.r);
                    if(resp.r !== false){
                        location.href = "../home.php";
                    }else{
                        $("#error").removeClass("d-none");
                    }
                }).catch( err => console.error( err ));


        });


    });

</script>

<?php foot(); ?>