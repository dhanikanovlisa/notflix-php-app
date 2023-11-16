const card_container = document.getElementById("result-container");

const PHP_REST_URL = `http://localhost:8000`;

function loadPremiumFilms(){
    console.log("tes");
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${PHP_REST_URL}/films/premium-film`);
    console.log("dfedger")
    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            var response = JSON.parse(xhr.responseText);
            if (xhr.status === 200){
                const films = response.data;
                    films.forEach(film => {
                        card_container.innerHTML += `
                            <a href="">
                                <div class="card premium">
                                    <img src="storage/poster/${film.film_poster}" alt="Film Poster" />
                                </div>
                            </a>`
                });
            }
        }
    }
}

loadPremiumFilms();