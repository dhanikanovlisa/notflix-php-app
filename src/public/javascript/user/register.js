const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone-number');
const firstNameInput = document.getElementById('first-name');
const lastNameInput = document.getElementById('last-name');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');
const registrationForm = document.getElementById('registration-form');

const usernameAlert = document.getElementById('username-alert');
const emailAlert = document.getElementById('email-alert');
const phoneAlert = document.getElementById('phone-alert');
const nameAlert = document.getElementById('name-alert');
const passwordAlert = document.getElementById('password-alert');
const confirmPasswordAlert = document.getElementById('confirm-password-alert');

let isUsernameValid = false;
let isEmailValid = false;
let isPhoneValid = false;
let isFirstNameValid = false;
let isLastNameValid = false;
let isPasswordValid = false;
let isConfirmPasswordValid = false;

const toast= document.getElementById("toast");

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

function registrationSuccessToast(){
    const image = document.getElementById("toast-img");
    const message = document.getElementById("toast-msg");

    image.src = "/images/assets/check.png";
    message.className = "check";
    message.innerHTML = "Registration success, redirecting to login page...";
    toast.className = "show";
}

function registrationFailedToast(){
    const image = document.getElementById("toast-img");
    const message = document.getElementById("toast-msg");

    image.src = "/images/assets/cross.png";
    message.className = "cross";
    message.innerHTML = "Invalid input, please check your input again";
    toast.className = "show";
}

const usernameRegex = /^[a-z0-9_\.]+$/;
const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const phoneRegex = /^\+[0-9]{7,14}$/;
const nameRegex = /^[a-z ,.'-]+$/i;


usernameInput && usernameInput.addEventListener('keyup', async(e) => {
    const username = usernameInput.value;

    if (!usernameRegex.test(username)) {
        setErrorWarning(usernameInput, usernameAlert, 'Username format is incorrect');
        isUsernameValid = false;
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
                    setErrorWarning(usernameInput, usernameAlert, 'Username is already registered');
                    isUsernameValid = false;
                    return;
                } else {
                    isUsernameValid = true;
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
        isEmailValid = false;
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
                    isEmailValid = false;
                    return;
                } else {
                    isEmailValid = true;
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
        isPhoneValid = false;
    }
    else {
        removeErrorWarning(phoneInput, phoneAlert);
        isPhoneValid = true;
    }
});

firstNameInput && firstNameInput.addEventListener('keyup', () => {
    const firstName = firstNameInput.value;
    if (!nameRegex.test(firstName)) {
        setErrorWarning(firstNameInput, nameAlert, 'First name format is incorrect');
        isFirstNameValid = false;
    }
    else {
        removeErrorWarning(firstNameInput, nameAlert);
        isFirstNameValid = true;
    }
});

lastNameInput && lastNameInput.addEventListener('keyup', () => {
    const lastName = lastNameInput.value;
    if (!nameRegex.test(lastName)) {
        setErrorWarning(lastNameInput, nameAlert, 'Last name format is incorrect');
        isLastNameValid = false;
    }
    else {
        removeErrorWarning(lastNameInput, nameAlert);
        isLastNameValid = true;
    }
});

passwordInput && passwordInput.addEventListener('keyup', () => {
    const password = passwordInput.value;
    if (password.length < 6) {
        setErrorWarning(passwordInput, passwordAlert, 'Password must be at least 6 characters');
        isPasswordValid = false;
    }
    else {
        isPasswordValid = true;
        removeErrorWarning(passwordInput, passwordAlert);
    }
});

confirmPasswordInput && confirmPasswordInput.addEventListener('keyup', () => {
    const confirmPassword = confirmPasswordInput.value;
    if (confirmPassword !== passwordInput.value) {
        setErrorWarning(confirmPasswordInput, confirmPasswordAlert, 'Password does not match');
        isConfirmPasswordValid = false;
    }
    else {
        isConfirmPasswordValid = true;
        removeErrorWarning(confirmPasswordInput, confirmPasswordAlert);
    }
});

registrationForm && registrationForm.addEventListener('submit', async (e) => {
    if (isUsernameValid && isEmailValid && isPhoneValid && isFirstNameValid && isLastNameValid && isPasswordValid && isConfirmPasswordValid) {
        e.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/register/register');

        const formData = new FormData();
        formData.append('username', usernameInput.value);
        formData.append('email', emailInput.value);
        formData.append('phone', phoneInput.value);
        formData.append('firstName', firstNameInput.value);
        formData.append('lastName', lastNameInput.value);
        formData.append('password', passwordInput.value);

        xhr.send(formData);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                registrationSuccessToast();
                setTimeout(function(){ 
                    toast.className = toast.className.replace("show", ""); 
                }, 1700);
                setTimeout(function(){ 
                    location.replace(response.redirect_url);
                }, 1700);
            }
        }
    } else {
        registrationFailedToast();
        setTimeout(function(){ 
            toast.className = toast.className.replace("show", ""); 
        }, 1700);
        e.preventDefault();
    }
});
