document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.cards');

    const fillCard = (dataUser) => {
        dataUser.forEach((user, index) => {
            const photo = cards[index].querySelector("img");
            photo.setAttribute("src", user.photo);
        });
    }

    fillCard(userData);
});
