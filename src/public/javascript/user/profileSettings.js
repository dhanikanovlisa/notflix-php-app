const upgradeButton = document.getElementById('upgradeButton');

function upgradeButtonClick() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/upgrade-premium');

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.data) {
                    upgradeButton.style.display = 'none';
                }
            } else {
                console.log("fail");
            }
        }
    };

    xhr.send();
}
