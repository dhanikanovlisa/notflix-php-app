const videoPlayer = document.getElementById('video-player');
const buttonWatchlist = document.getElementById('watchlist-button');
const pathname = window.location.pathname.split('/');
const filmID = pathname[pathname.length-1];

const updateTime = () => {
    document.cookie = 'lastPlayedTime/'+filmID+'='+videoPlayer.currentTime;
}

let timeoutId = null;
const delayInvoke = (fn, interval) => {
    return async () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(()=>{fn();clearTimeout(timeoutId);timeoutId=null;}, interval);
    }
}

const delayTimeUpdate = delayInvoke(updateTime, 5000);

videoPlayer && videoPlayer.addEventListener('timeupdate', ()=>{
    if(timeoutId === null){
        delayTimeUpdate();
    }
});

buttonWatchlist && buttonWatchlist.addEventListener('click', ()=>{
    let value = buttonWatchlist.value;
    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('film_id', filmID);
    
    if(value==='add'){
        xhr.open('POST', '/add/watchlist', true);
        xhr.send(formData);
        
        xhr.onreadystatechange = async () =>{
            if(xhr.readyState !== XMLHttpRequest.DONE) return;
            if(xhr.status === 200){
                buttonWatchlist.innerText = 'Remove from watchlist';
                buttonWatchlist.setAttribute('value', 'remove');
                
            }
        }
    }
    else if(value==='remove'){
        xhr.open('POST', '/delete/watchlist', true);
        xhr.send(formData);

        xhr.onreadystatechange = async () =>{
            if(xhr.readyState !== XMLHttpRequest.DONE) return;
            if(xhr.status === 200){
                buttonWatchlist.innerText = 'Add to Watchlist';
                buttonWatchlist.setAttribute('value', 'add');
            }
        }
    }
});

const heart = document.getElementById('heart');
const likescount = document.getElementById('likecounter');

heart && heart.addEventListener('click', function() {
    this.classList.toggle('is_animating');

    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('film_id', filmID);

    if (this.classList.contains('dislike')) {
        xhr.open('POST', '/add/like', true);
        xhr.send(formData);

        xhr.onreadystatechange = async () =>{
            if(xhr.readyState !== XMLHttpRequest.DONE) return;
            if(xhr.status === 200){
                console.log(xhr.responseText)
                const res = JSON.parse(xhr.responseText);
                this.classList.remove('dislike');
                this.className += ' like';
                likescount.innerText = res.likes_count;
            }
        }
    } else {
        xhr.open('POST', '/delete/like', true);
        xhr.send(formData);

        xhr.onreadystatechange = async () =>{
            if(xhr.readyState !== XMLHttpRequest.DONE) return;
            if(xhr.status === 200){
                console.log(xhr.responseText)
                const res = JSON.parse(xhr.responseText);
                this.classList.remove('like');
                this.className += ' dislike';
                likescount.innerText = res.likes_count;
            }
        }
    }
});

heart && heart.addEventListener('animationend', function() {
    if (this.classList.contains('dislike')) {
        this.classList.toggle('is_animating');
    }
});