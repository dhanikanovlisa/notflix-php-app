const toast= document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const watchlist = document.querySelector("#watchlist");

function watchListButton(){
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/check/watchlist/' + film_id);

    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            var response = JSON.parse(xhr.responseText);
            if (!response.isExist){
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/add/watchlist');
                const form_data = new FormData();
                form_data.append('film_id', film_id);
                xhr.send(form_data);
                xhr.onreadystatechange = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE){
                        response = JSON.parse(xhr.responseText);
                        image.src = "/images/assets/check.png";
                        message.className = "check";
                        message.innerHTML = response.message;
                        toast.className = "show";
                        watchlist.innerHTML = "✔";
                    }
                }
            } else {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/delete/watchlist');
                const form_data = new FormData();
                form_data.append('film_id', film_id);
                xhr.send(form_data);
                xhr.onreadystatechange = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE){
                        response = JSON.parse(xhr.responseText);
                        image.src = "/images/assets/cross.png";
                        message.className = "cross"
                        message.innerHTML = response.message;
                        toast.className = "show";
                        watchlist.innerHTML = "+";
                    }
                }
            }
        }
    }
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 1700);
}


document.addEventListener('DOMContentLoaded', async function () {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/check/watchlist/' + film_id);

    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            var response = JSON.parse(xhr.responseText);
            if (response.isExist){
                watchlist.innerHTML = "✔";
            } else {
                watchlist.innerHTML = "+";
            }
        }
    }
});