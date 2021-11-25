<?php

namespace views;

require "../../app/autoload.php";
include "./layouts/main.php";

use Controllers\auth\LoginController as LoginController;

$ua = new LoginController;

is_null($ua->sessionValidate()) ? header("Location: /resources/views/auth/inisesion.php") : '';

head($ua);

?>
<section class="container pt-5">

    <h1 class="border-bottom">Nueva publicación</h1>

    <form action="/ejercicioT/app/app.php" method="post">
        <input type="hidden" name="uid" value="<?=$ua->uid?>">
        <input type="hidden" name="guardarpublicacion" value="true">
        <div class="mb-3">
            <lable for="title" class="form-label">Titulo</lable>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titulo de la publicación" required>
        </div>
        <div class="mb-3">
            <lable for="body" class="form-label">Texto</lable>
            <textarea name="body" class="form-control" rows="5" id="body" placeholder="Texto de la publicación" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

</section>

<?php

scripts();

foot();