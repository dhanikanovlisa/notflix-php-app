const navbar_link = document.getElementById("navbar-link");
const photo_profile = document.getElementById("photo-profile");
const usermenu = document.querySelector("#user-menu")

function navbar(){
    if (navbar_link.className === "navbar-link") {
        navbar_link.className += " responsive";
        if(photo_profile) photo_profile.className += " resp-mode";
        if(usermenu) usermenu.style.display = 'none';
        
    } else {
        navbar_link.className = "navbar-link";
        if(photo_profile) photo_profile.className = "photo-profile";
    }
}

function logout(){
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/logout');
    xhr.send();
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            location.replace('/login');
        }
    }
}

function userMenu(){
    let usermenu = document.querySelector("#user-menu")
    if (photo_profile.className == "photo-profile resp-mode") return;
    if (usermenu.style.display=="block"){
        usermenu.style.display = "none";
    } else {
        usermenu.style.display = "block";
    }
}

window.onclick = function(e){
    if (navbar_link && navbar_link.className === "navbar-link responsive"){
        if (e.target.className != "burger-bar" && e.target.className != "navbar-link responsive"){
            navbar_link.className = "navbar-link";
            if(photo_profile) photo_profile.className = "photo-profile";
        }
    }


}