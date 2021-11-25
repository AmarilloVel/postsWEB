const app = {

    groute : "app/",

    routes : {
        'inisesion' : "/ejercicioT/resources/views/auth/inisesion.php",
        'login' : "/ejercicioT/app/app.php",
        'logout' : "/ejercicioT/app/app.php?logout",
        'myposts' : "/ejercicioT/resources/views/myposts.php",
        'newpost' : "/ejercicioT/resources/views/newpost.php",
    },

    pp : $(".previous-posts"),
    lp : $(".last-post"),
    auth : $(".authors"),

    view : (route) => {
        location.replace(app.routes[route]);
    },

    previousPosts : () => {
        let html = `<b>Aun no hay publicaciones</b>`;
        app.pp.html("");
        fetch(app.routes.login + "?pp")
            .then( response => response.json())
            .then( ppresp => {
                if( ppresp.length > 0){
                    html = "";
                    primera = true;
                    for( let post of ppresp){
                        html += `
                            <a href="#" onclick="app.openPost(event,${ post.id },this)" 
                                class="list-group-item list-group-item-action ${ primera ? `active` : ``} pplg">
                                <div class="w-100 border-bottom">
                                    <h5 class="mb-1">${ post.title}</h5>
                                    <small class="text-${ primera ? `light` : `muted` }"><i class="bi bi-calendar-week"></i> ${ post.fecha }</small>
                                </div>
                                <p class="mb-1">${ post.body.substr(1,100) }...</p>
                                <small><i class="bi bi-person-circle"></i> <b>${ post.name }</b></small>
                            </a>
                        `;
                        primera = false;
                    }
                }
                app.pp.html(html);
            }).catch( err => console.error( err ));
    },
    lastPost : function(limit){
        let html = `<h2>Aun no hay publicaciones</h2>`;
        app.lp.html("");
            fetch(app.routes.login + "?lp&limit=" + limit)
            .then( response => {
                //console.info(response);
                return response.json();})
            .then( lpresp => {                
                if( lpresp.length > 0){
                    html = `
                        <div class="w-100 border-bottom">
                            <h5 class="mb-1">${ lpresp[0].title }</h5>
                            <small class="text-muted">
                                <i class="bi bi-calendar-week"></i> ${ lpresp[0].fecha } | 
                                <i class="bi bi-person-circle"></i> <b>${ lpresp[0].name }</b>
                            </small>
                        </div>
                        <p class="mb-1">${ lpresp[0].body }</p>
                    `;

                }
                this.lp.html(html);
            }).catch( err => console.error( err ));
    },
    openPost : function(e,id,el){
        $(".pplg").removeClass("active");
        el.classList.add("active");
        e.preventDefault();
        let html = "";
        this.lp.html("");
        fetch(app.routes.login + "?op&id=" + id)
            .then( response => response.json())
            .then( opresp => {
                html = `
                    <div class="w-100 border-bottom">
                        <h5 class="mb-1">${ opresp[0].title }</h5>
                        <small class="text-muted">
                            <i class="bi bi-calendar-week"></i> ${ opresp[0].fecha } | 
                            <i class="bi bi-person-circle"></i> <b>${ opresp[0].name }</b>
                        </small>
                    </div>
                    <p class="mb-1">${ opresp[0].body }</p>
                `;
                this.lp.html(html);
            }).catch( err => console.error( err ));
    },


};