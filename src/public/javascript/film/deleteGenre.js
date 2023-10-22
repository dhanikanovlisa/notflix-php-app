var btn = document.getElementById("deleteButton");
var span = document.getElementsByClassName("close")[0];
var closeButton = document.getElementById("cancel");
var okButton = document.getElementById("ok");

function popModal(genreId) {
    var modal = document.getElementById('confModal_' + genreId);
    modal.style.display = "block";
}

function closeModal(genreId) {
    var modal = document.getElementById('confModal_' + genreId);
    modal.style.display = "none";
}

const toast = document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const deleteButton = document.querySelector("#ok");

function success() {
    if (deleteButton.innerHTML == "OK") {
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Successfully deleted genre";
        toast.className = "show";
    }

    setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 1700);
}

function fail() {
    if (deleteButton.innerHTML == "OK") {
        image.src = "/images/assets/cross.png";
        message.className = "cross";
        message.innerHTML = "Cannot delete genre";
        toast.className = "show";
    }

    setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 1700);
}

const deleteGenre = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/delete-genre/:' + id);

    const formData = new FormData();
    formData.append('genre_id', id);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                success();
                setTimeout(() => {
                    location.replace(response.redirect_url);
                }, 1000);
                closeModal(id); // Close modal by passing the genreId
            } else {
                fail();
            }
        }
    }
    xhr.send(formData);
}
