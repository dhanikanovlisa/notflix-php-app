let filmName = document.getElementById('filmName');
let filmDescription = document.getElementById('filmDescription');
let filmPoster = document.getElementById('filmPoster');
let filmVideo = document.getElementById('filmVideo');
let filmHeader = document.getElementById('filmHeader');
let filmHourDuration = document.getElementById('filmHourDuration');
let filmMinuteDuration = document.getElementById('filmMinuteDuration');
let date = document.getElementById('filmDate');
let filePosterName = document.getElementById('display-filePoster-name');
let fileVideoName = document.getElementById('display-fileVideo-name');
let fileHeaderName = document.getElementById('display-fileHeader-name');
const filmNameAlert = document.getElementById('filmName-alert');
const toast = document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const saveButton = document.querySelector("#saveButton");


let selectedGenres = [];
document.addEventListener('DOMContentLoaded', function () {
    let genreCheckboxes = document.querySelectorAll('.check-container input[type="checkbox"]');
    genreCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                selectedGenres.push(this.value);
            } else {
                selectedGenres = selectedGenres.filter(value => value !== this.value);
            }

        });
    });
});

var modal = document.getElementById("confModal");
var btn = document.getElementById("deleteButton");
var span = document.getElementsByClassName("close")[0];
var closeButton = document.getElementById("cancel");
var okButton = document.getElementById("ok");

function popModal() {
    modal.style.display = "block";
}
function closeModal() {
    modal.style.display = "none";
}

filmPoster.addEventListener('change', () => {
    filePosterName.textContent = "File Name: " + filmPoster.files[0].name;
    let message = document.getElementById("film-poster-alert");
    if (filmPoster.files[0]) {
        if (filmPoster.files[0].size > 800 * 1024) {
            message.innerHTML = "File size must be less than 800KB";
        } else {
            message.innerHTML = "";
        }
    }
});

filmVideo.addEventListener('change', () => {
    fileVideoName.textContent = "File Name: " + filmVideo.files[0].name;
    let message = document.getElementById("film-video-alert");
    if (filmVideo.files[0]) {
        if (filmVideo.files[0].size > 10 * 1024 * 1024) {
            message.innerHTML = "File size must be less than 10MB";
        } else {
            message.innerHTML = "";
        }
    }
});

filmHeader.addEventListener('change', () => {
    fileHeaderName.textContent = "File Name: " + filmHeader.files[0].name;
    if (filmHeader.files[0]) {
        let message = document.getElementById("film-header-alert");
        if (filmHeader.files[0].size > 800 * 1024) {
            message.innerHTML = "File size must be less than 800KB";
        } else {
            message.innerHTML = "";
        }
    }
});

function succes() {
    image.src = "/images/assets/check.png";
    message.className = "check";
    message.innerHTML = "Succesfully edited film";
    toast.className = "show";
    setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 1700);
}

function failed() {
    image.src = "/images/assets/cross.png";
    message.className = "cross";
    message.innerHTML = "Failed edited film";
    toast.className = "show";
    setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 1700);
}

function removeErrorWarning(input, desc) {
    desc.style.display = 'none';
}

filmName && filmName.addEventListener('keyup', async (e) => {
    const film_name = filmName.value;
    e.preventDefault();
    const xhr_uname = new XMLHttpRequest();
    xhr_uname.open('GET', '/check/filmname/:' + film_name);

    xhr_uname.send();
    xhr_uname.onreadystatechange = () => {
        if (xhr_uname.readyState === XMLHttpRequest.DONE) {
            const response = JSON.parse(xhr_uname.responseText);
            if (response.isExist) {
                setErrorWarning(filmName, filmNameAlert, 'Film Name Already Exist');
                return;
            }
        }
    }
    removeErrorWarning(filmName, filmNameAlert);
});

function closePage() {
    location.replace('/manage-film');
}

editFilmForm && editFilmForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/update/film');

    const formData = new FormData();
    formData.append('film_id', filmID);
    formData.append('title', filmName.value);
    formData.append('description', filmDescription.value);
    selectedGenres.forEach(genre => {
        formData.append('filmGenre[]', genre);
    });
    formData.append('filmHourDuration', filmHourDuration.value);
    formData.append('filmMinuteDuration', filmMinuteDuration.value);
    if (filmPoster.files[0] != undefined) {
        console.log(filmPoster.files[0].size);
        formData.append('film_poster', filmPoster.files[0].name);
        formData.append('film_poster_size', filmPoster.files[0].size);
    } else {
        formData.append('film_poster', '');
    }

    if (filmVideo.files[0] != undefined) {
        console.log(filmVideo.files[0].size)
        formData.append('film_path', filmVideo.files[0].name);
        formData.append('fim_path_size', filmVideo.files[0].size);
    } else {
        formData.append('film_path', '');
    }

    if (filmHeader.files[0] != undefined) {
        console.log(filmHeader.files[0].size)
        formData.append('film_header', filmHeader.files[0].name);
        formData.append('film_header_size', filmHeader.files[0].size);
    } else {
        formData.append('film_header', '');

    }
    formData.append('date_release', date.value);


    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log("200");
                const response = JSON.parse(xhr.responseText);
                let messagePoster = document.getElementById("film-poster-alert");
                let messageVideo = document.getElementById("film-video-alert");
                let messageHeader = document.getElementById("film-header-alert");
                messagePoster.innerHTML = "";
                messageVideo.innerHTML = "";
                messageHeader.innerHTML = "";
                succes();
                setTimeout(() => {
                    location.replace(response.redirect_url);
                }, 1500);
            } else if (xhr.status === 413) {
                const response = JSON.parse(xhr.responseText);
                failed();
            }
        }
    }
    xhr.send(formData);
});