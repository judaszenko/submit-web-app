function shrinkPosts(){
    let posts = document.getElementsByClassName("newpost_text");
// console.log(posts);
        
    for(post of posts){
        if(post.textContent.length >= 300){
            let adress = "{{path('app_post {id: post.User.id}')}}"
            post.innerHTML = post.textContent.substring(0, 300) + "... [...]";
    }
    }    
    
}

shrinkPosts();

document.getElementsByClassName('')