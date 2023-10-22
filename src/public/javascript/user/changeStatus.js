function succes() {
    if (changeButton.innerHTML == "Change To Admin") {
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully changed to admin";
        toast.className = "show";
    } else if (changeButton.innerHTML === "Change To User"){
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
            succes();
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
            succes();
            setTimeout(() => {
                location.replace(response.redirect_url);
            }, 1000);
        }
    }
    xhr.send(formData);
};

const changeButton = document.querySelector("#change");
