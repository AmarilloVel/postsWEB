const app_myposts = {

    url : "/ejercicioT/app/app.php",

    mp : $("#my-posts"),
    myP : $("#myP"),
    ed : $("#edit"),

    getMyPosts : function(uid){
        let html = `<tr><td colspan="3">No tiene publicaciones</td></tr>`;
        this.mp.html("");
        fetch(this.url + "?mp&id=" + uid)
            .then( resp => resp.json())
            .then( mpresp => {
                
                if(mpresp.length > 0){
                    for( let post of mpresp){
                        
                        html = `
                            <tr>
                                <td>${ post.title }</td>
                                <td>${ post.created_at }</td>
                                <td>
                                    <button type="button" class="btn bi bi-pencil-fill" onclick="app_myposts.updatePost('${post.userId}')"></button>
                                    <button type="button" class="btn bi bi-trash-fill" onclick="app_myposts.deletePost('${post[1]}')"></button>
                                </td>
                            </tr>
                        `;
                    }                 
                }
                this.mp.html(html);
            }).catch( err => console.error( err ));


    },
    deletePost : function(id){
        
        
        fetch(this.url + "?dp&id=" + id)
            .then( resp => {
               
                location.replace("myposts.php");
            }).catch( err => console.error( err ));
    },


    updatePost: function(uid){
        this.ed.html("");
        fetch(this.url + "?mp&id=" + uid)
            .then( resp => resp.json())
            .then( mpresp => {
                if(mpresp.length > 0){
                    for( let post of mpresp){
                        html= `
                            <section class="container pt-5">

                                <h1 class="border-bottom">Editar Publicacion</h1>
                            
                                <form action="/app/app.php" method="post">
                                    <input type="hidden" name="id" value='${post.id}'>
                                    <input type="hidden" name="editarpublicacion" value="true">
                                    <div class="mb-3">
                                        <lable for="title" class="form-label">Titulo</lable>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="as" value="${post.title}"required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Texto</label>
                                        <textarea name="body" class="form-control" rows="5" id="body" placeholder="Texto de la publicación" required>${post.body}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                        
                            </section>`;
                    }

                }
                this.myP.addClass("d-none");
                


                this.ed.html(html);
            })
            .catch( err => console.error( err ));


    },

};