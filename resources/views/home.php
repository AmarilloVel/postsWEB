<?php

namespace views;

require "../../app/autoload.php";
include "./layouts/main.php";

use Controllers\auth\LoginController as LoginController;

head(new LoginController);

?>

<div class="container">

    <div class="row mt-5">
        <div class="col-4">
            <div class="list-group previous-posts">
            
            </div>
        </div>
        <div class="col-6 last-post shadow rounded p-3-mb-5">
        
        </div>
        <div class="col">
            <div class="list-group authors">
            
            </div>
        </div>
    </div>

</div>

<?php scripts(); ?>

<script type="text/javascript">

$(function(){
    app.previousPosts();
    app.lastPost(1);
});

</script>

<?php

    foot();