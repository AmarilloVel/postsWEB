<?php

namespace Controllers;

use Models\posts;

class PostsController {


    public function __contruct(){}


    //**Guardar nueva publicación */
    public function newPost($datos){
        $post = new posts();
        $post->valores = [$datos['uid'],$datos['title'],$datos['body']];
        $result = $post->create();
    }

    //**Obtener mis publicaciones */
    public function getMyPosts($id){
        $posts = new posts();
        $result = $posts->where([['userId',$id]])->get();
        return $result;
    }

    /**Obtener las publicaciones más recientes */
    public function getPosts($limit=""){
        $post = new posts();
        $result = $post->select(['a.id','a.title','a.body','date_format(a.created_at,"%d/%m/%Y") as fecha','b.name'])
                        ->join('user b','a.userId=b.id')
                        ->orderBy([['created_at','DESC']])
                        ->limit($limit)
                        ->get();
        return $result;
    }

    public function openPost($id){
        $post = new posts();
        $result = $post->select(['a.id','a.title','a.body','date_format(a.created_at,"%d/%m/%Y") as fecha','b.name'])
                        ->join('user b','a.userId=b.id')
                        ->where([['a.id',$id]])
                        ->get();
        return $result;
    }

    public function deletePost($id){
        $post = new posts();
        
        $result = $post->delete($id);
                        /* ->where([['id',$id]]); */
       
        return $result;
                        
    }

    public function editPost($datos){
        $post = new posts();
        
        $result = $post->edit($datos['title'],$datos['body'],$datos['id']);
    }
                        
    

}