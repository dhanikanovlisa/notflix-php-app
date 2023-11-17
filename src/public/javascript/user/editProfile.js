let usernameInput = document.getElementById('username');
let firstNameInput = document.getElementById('first-name');
let lastNameInput = document.getElementById('last-name'); 
let emailInput = document.getElementById('email');
let phoneInput = document.getElementById('phone-number');
let profilePicture = document.getElementById('photoProfile');
let fileName = document.getElementById('display-file-name');

const usernameAlert = document.getElementById('username-alert');
const emailAlert = document.getElementById('email-alert');
const phoneAlert = document.getElementById('phone-alert');
const nameAlert = document.getElementById('name-alert');
const passwordAlert = document.getElementById('password-alert');
const confirmPasswordAlert = document.getElementById('confirm-password-alert');


const toast= document.getElementById("toast");
const image = document.getElementById("toast-img");
const message = document.getElementById("toast-msg");
const saveButton = document.querySelector("#saveButton");

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

function displayFileName(name){
    fileName.innerText = name;
}

profilePicture.addEventListener('change', () => {
    fileName.textContent ="File Name: " +  profilePicture.files[0].name;
});

function popModal() {
    modal.style.display = "block";
}
function closeModal() {
    modal.style.display = "none";
}
const closePage = (id) => {
    location.replace('/settings/' + id);
}

const usernameRegex = /^[a-z0-9_\.]+$/;
const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const phoneRegex = /^\+[0-9]{7,14}$/;
const nameRegex = /^[a-z ,.'-]+$/i;

let usernameValid = false;
let emailValid = false;
let passwordValid = false;
let passwordConfirmedValid = false;

usernameInput && usernameInput.addEventListener('keyup', async(e) => {
    const username = usernameInput.value;

    if (!usernameRegex.test(username)) {
        setErrorWarning(usernameInput, usernameAlert, 'Username format is incorrect');
        return;
    }
    else {
        e.preventDefault();
        const xhr_uname = new XMLHttpRequest();
        xhr_uname.open('GET', '/check/username/:' + username);
        
        xhr_uname.send();
        xhr_uname.onreadystatechange = () => {
            if (xhr_uname.readyState === XMLHttpRequest.DONE){
                const response = JSON.parse(xhr_uname.responseText);
                if (response.isExist){
                    setErrorWarning(usernameInput, usernameAlert, 'Username is not available');
                    return;
                }
            }
        }
        removeErrorWarning(usernameInput, usernameAlert);
    }
});

emailInput && emailInput.addEventListener('keyup', async (e) => {
    const email = emailInput.value;
    if (!emailRegex.test(email)) {
        setErrorWarning(emailInput, emailAlert, 'Email format is incorrect');
        return;
    }
    else {
        e.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/check/email/:' + email);
        
        xhr.send();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE){
                const response = JSON.parse(xhr.responseText);
                if (response.isExist){
                    setErrorWarning(emailInput, emailAlert, 'Email is already registered');
                    return;
                }
            }
        }
    }
    removeErrorWarning(emailInput, emailAlert);
});

phoneInput && phoneInput.addEventListener('keyup', () => {
    const phone = phoneInput.value;
    if (!phoneRegex.test(phone)) {
        setErrorWarning(phoneInput, phoneAlert, 'Phone number format is incorrect');
    }
    else {
        removeErrorWarning(phoneInput, phoneAlert);
    }
});

firstNameInput && firstNameInput.addEventListener('keyup', () => {
    const firstName = firstNameInput.value;
    if (!nameRegex.test(firstName)) {
        setErrorWarning(firstNameInput, nameAlert, 'First name format is incorrect');
    }
    else {
        removeErrorWarning(firstNameInput, nameAlert);
    }
});

lastNameInput && lastNameInput.addEventListener('keyup', () => {
    const lastName = lastNameInput.value;
    if (!nameRegex.test(lastName)) {
        setErrorWarning(lastNameInput, nameAlert, 'Last name format is incorrect');
    }
    else {
        removeErrorWarning(lastNameInput, nameAlert);
    }
});


function succes(){
    if(saveButton.innerHTML == "Save"){
        image.src = "/images/assets/check.png";
        message.className = "check";
        message.innerHTML = "Succesfully edited profile";
        toast.className = "show";
    }

    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 1700);
}


profilePicture.addEventListener('change', () => {
    let message = document.getElementById("error-upload");
    if (profilePicture.files[0]) {
        if (profilePicture.files[0].size > 8 * 1024) {
            message.innerHTML = "File size must be less than 800KB";
        } else {
            message.innerHTML = ""; 
        }
    }
});

editProfile && editProfile.addEventListener('submit', async (e) => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('user_id', userID);
    formData.append('username', usernameInput.value);
    formData.append('first_name', firstNameInput.value);
    formData.append('last_name', lastNameInput.value);
    formData.append('email', emailInput.value);

    formData.append('phone_number', phoneInput.value);
    if(profilePicture.files[0] !== undefined){
        formData.append('photo_profile', profilePicture.files[0].name);
        formData.append('photo_size', profilePicture.files[0].size);
    } else {
        formData.append('photo_profile', "");
    }

    xhr.open('POST', '/update-profile');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 ) {
            if(xhr.status === 200){
                const response = JSON.parse(xhr.responseText);
                let message = document.getElementById("error-upload");
                message.innerHTML = "";
                succes(); 
                setTimeout(() => {
                    location.replace(response.redirect_url);
                }, 1500);
            } else if(xhr.status === 413){
                let message = document.getElementById("error-upload");
                message.innerHTML = "File size must be less than 800KB";
            }
        }
    };

    xhr.send(formData); 
});
