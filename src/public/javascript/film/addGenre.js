const toast = document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const submitButton = document.querySelector("#submitButton");

function succes(){
    if (submitButton.innerHTML == "Submit") {
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully added new genre";
        toast.className = "show";
    }
}

function setErrorWarning(input, desc, message){
    input.className += ' error-input';
    desc.innerText = message;
    desc.style.display = 'block';
}

function removeErrorWarning(input, desc){
    input.className = '';
    desc.innerText = '';
    desc.style.display = 'none';
}

var genreName = document.getElementById('genre');
const genreAlert = document.getElementById('genre-alert')
genreName && genreName.addEventListener('keyup', async(e) => {
    const genre = genreName.value;
    if (genre == "") {
        setErrorWarning(genreName, genreAlert, 'Genre name cannot be empty');
        return;
    }
    else {
        e.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/check/genre/:' + genre);
        
        xhr.send();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE){
                const response = JSON.parse(xhr.responseText);
                if (response.isExist){
                    setErrorWarning(genreName, genreAlert, 'Genre already exists');
                    return;
                }
            }
        }
        removeErrorWarning(genreName, genreAlert);
    }
}) 

addGenreForm && addGenreForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/add/genre');


    let formData = new FormData();

    formData.append('name', genreName.value);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            succes();
            setTimeout(() => {
                location.replace(response.redirect_url);
            }, 1500);
        }
    }
    xhr.send(formData);
});