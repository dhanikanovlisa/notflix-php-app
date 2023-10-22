var modal = document.getElementById("confModal");
var btn = document.getElementById("deleteButton");
var span = document.getElementsByClassName("close")[0];
var closeButton = document.getElementById("cancel");
var okButton = document.getElementById("ok");
const changeButton = document.getElementById("change");

function popModal() {
    modal.style.display = "block";
}
function closeModal() {
    modal.style.display = "none";
}
const toast = document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const deleteButton = document.querySelector("#ok");


function succes(action) {
     if (action==="delete") {
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully deleted user";
        toast.className = "show";
    }
    if (action==="changeToAdmin") {
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully changed to admin";
        toast.className = "show";
    } else if (action==="changeToUser"){
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully changed to user";
        toast.className = "show";
    }

    setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 1700);
}

const changeToAdmin = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/change-to-admin/:' + id);

    const formData = new FormData();
    formData.append('user_id', id);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            succes("changeToAdmin");
            setTimeout(() => {
                location.replace(response.redirect_url);
            }, 1000);
        }
    }
    xhr.send(formData);
};

const changeToUser = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/change-to-user/:' + id);

    const formData = new FormData();
    formData.append('user_id', id);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            succes("changeToUser");
            setTimeout(() => {
                location.replace(response.redirect_url);
            }, 1000);
        }
    }
    xhr.send(formData);
};



const deleteUser = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/delete-user');

    const formData = new FormData();
    formData.append('user_id', id);
   
    xhr.send(formData);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            modal.style.display = "none";
            succes("delete");
            setTimeout(() => {
                location.replace(response.redirect_url);
            }, 1000);
        }
    }
}
