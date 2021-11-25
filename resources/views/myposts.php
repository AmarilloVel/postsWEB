<?php

namespace views;

require "../../app/autoload.php";
include "layouts/main.php";

use Controllers\auth\LoginController as LoginController;

$ua = new LoginController;

is_null($ua->sessionValidate()) ? header("Location: /resources/views/auth/inisesion.php") : '';

head($ua);

?>

<section class="container pt-5" id="myP">
   <div class="card">
    <div class="card-header">
        Mis publicaciones
        <button type="button" class="btn btn-primary float-end" onclick="app.view('newpost')">
            Nueva publicación
        </button>
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th><i class="bi bi-gear-fill"></i></th>
                </tr>
            </thead>
            <tbody id="my-posts">
            
            </tbody>
        </table>
    </div>
   </div>


</section>
<section class="container pt-5" id="edit">



</section>

<?php

scripts("app_myposts.js");

?>
<!-- <script src="/resources/js/app_myposts.js"></script> -->
<script>
$(function(){
    app_myposts.getMyPosts(<?=$ua->uid?>);
});
</script>


<?php


foot();