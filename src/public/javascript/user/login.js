const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');
const loginForm = document.querySelector('#login-form');
const loginAlert = document.getElementById('login-alert');

function setErrorWarning(desc, message){
    desc.innerText = message;
}

function removeErrorWarning(desc){
    desc.innerText = '';
}

const usernameRegex = /^[a-z0-9_\.]+$/;

loginForm && loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const xhr_uname = new XMLHttpRequest();
    xhr_uname.open('GET', '/check/username/:' + usernameInput.value);
    
    xhr_uname.send();
    xhr_uname.onreadystatechange = () => {
        if (xhr_uname.readyState === XMLHttpRequest.DONE){
            const response = JSON.parse(xhr_uname.responseText);
            if (!response.isExist){
                setErrorWarning(loginAlert, 'Username does not exist');
                return;
            } else {
                const xhr_pass = new XMLHttpRequest();
                xhr_pass.open('POST', '/auth/login');
            
                const formData = new FormData();
                formData.append('username', usernameInput.value);
                formData.append('password', passwordInput.value);
            
                xhr_pass.send(formData);
                xhr_pass.onreadystatechange = () => {
                    if (xhr_pass.readyState === XMLHttpRequest.DONE) {
                        if (xhr_pass.status === 401){
                            setErrorWarning(loginAlert, 'Username or password is incorrect');
                            return;
                        }
                        const response = JSON.parse(xhr_pass.responseText);
                        location.replace(response.redirect_url);
                    }
                }
            }
        }
    }
});

usernameInput && usernameInput.addEventListener('keyup', () => {
    removeErrorWarning(loginAlert);
});

passwordInput && passwordInput.addEventListener('keyup', () => {
    removeErrorWarning(loginAlert);
});