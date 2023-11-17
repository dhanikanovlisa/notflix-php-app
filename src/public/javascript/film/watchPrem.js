const pathname = window.location.pathname.split('/');
const filmID = pathname[pathname.length-1];

const videoPlayer = document.getElementById('video-player');
const title = document.getElementById('title-in');
const description = document.getElementById('description-in');
const genre = document.getElementById('genre-in');
const release = document.getElementById('release-in');
const duration = document.getElementById('duration-in');

function generate(){
    console.log("Fgdfg")
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${PHP_REST_URL}/films/film/film/${filmID}`);
    console.log(filmID);
    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            console.log(response.data.film_path)
            if (xhr.status === 200){
                videoPlayer.innerHTML = `<source src='../storage/film/${response.data.film_path}'  type='video/mp4'/>`
                title.innerHTML = response.data.title;
                description.innerHTML = response.data.description;
                genre.innerHTML = response.genre;
                release.innerHTML = response.data.date_release.split('T')[0];
                duration.innerHTML = response.data.duration;
            }
        }
    }

}


generate();