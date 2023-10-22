var mainMessage = document.getElementById("main-message");
var desc = document.getElementById("description-message");

function modalConfirmation(message, description) {
    mainMessage.innerHTML = message;
    desc.innerHTML = description;
}