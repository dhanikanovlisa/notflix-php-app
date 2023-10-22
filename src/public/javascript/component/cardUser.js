document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.card-box');

    const fillCard = (dataUser) => {
        dataUser.forEach((user, index) => {
            const userNameElement = cards[index].querySelector("h3");
            const roleElement = cards[index].querySelector("p");

            userNameElement.textContent = user.name;
            roleElement.textContent = user.role;
        });
    }

    fillCard(userData);
});
