<?php

namespace app;

require_once "autoload.php";

use Controllers\auth\LoginController as LoginController;
use Controllers\PostsController as PostsController;

if(!empty($_POST)){

    //****************LOGIN */

    $login = \in_array('login',array_keys(\filter_input_array(INPUT_POST)));

    if($login){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userLogin = new LoginController();
        print_r($userLogin->userAuth($datos));
    }

    $gp = in_array('guardarpublicacion',array_keys(filter_input_array(INPUT_POST)));

    if($gp){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $npost = new PostsController();
        $npost->newPost($datos);
        header('Location: /ejercicioT/resources/views/myposts.php');
    }

    $ep = in_array('editarpublicacion',array_keys(filter_input_array(INPUT_POST)));

    if($ep){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $npost = new PostsController();
         $npost->editPost($datos); 
         header('Location: /ejercicioT/resources/views/myposts.php');
         
    }

}

if(!empty($_GET)){
    
    //****************LOGOUT */

    $logout = \in_array('logout',array_keys(\filter_input_array(INPUT_GET)));

    if($logout){    
        $userLogin = new LoginController();
        $userLogin->userLogout();
        header('Location: /resources/views/home.php');
    }

    /**Cargar mis publicaciones */
    $mp = \in_array('mp',array_keys(\filter_input_array(INPUT_GET)));
    if($mp){
        $id = filter_input_array(INPUT_GET)['id'];
        $posts = new PostsController();
        print_r($posts->getMyPosts($id));
    }

    /**Cargar las publicaciones más recientes */
    $pp =  \in_array('pp',array_keys(\filter_input_array(INPUT_GET)));
    if($pp){        
        $posts = new PostsController();
        print_r($posts->getPosts());
    }
    /**Cargar la última publicación */
    $lp = \in_array('lp',array_keys(\filter_input_array(INPUT_GET)));
    if($lp){     
        $limit = filter_input(INPUT_GET,'limit');
        $lpost = new PostsController();
        print_r($lpost->getPosts($limit));
    }
    /**Cargar una publicación específica*/
    $op = \in_array('op',array_keys(\filter_input_array(INPUT_GET)));
    if($op){     
        $id = filter_input(INPUT_GET,'id');
        $opost = new PostsController();
        print_r($opost->openPost($id));
    }
    /**Cargar una publicación específica*/
    $dp = \in_array('dp',array_keys(\filter_input_array(INPUT_GET)));
    if($dp){     
        $id = filter_input(INPUT_GET,'id');
        $dpost = new PostsController();
        print_r($dpost->deletePost($id));
    }

}