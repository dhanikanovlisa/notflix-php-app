const card_container = document.getElementById("result-container");

const LIMIT = 20;
let pagination_count = 0;

if (!window.location.href.includes("pages=")) {
    window.location.href+= "?pages=1";
}

const href = (window.location.href.split('pages='));
const pages = href[href.length-1];

function addButtonPagination(val, symbol, is_active){
    pagination_container.innerHTML += `
        <div class="button-pagination ${is_active? "button-red":"button-white"}" value=${val} symbol="${symbol}" onClick=handlePagination(this.getAttribute('value'))>
            ${symbol}
        </div>
    `
}

function generatePagination2(active, start, leftButton, rightButton){
    if (leftButton) {
        addButtonPagination(start-1, "<<", false);
    }
    for (let i = start; i < (start+5); i++) {
        let is_active = false;
        if (i == active) is_active = true;
        addButtonPagination(i, i , is_active);
    }
    if (rightButton) {
        addButtonPagination(start+5, ">>", false);
    }
}

const pagination_container = document.getElementById('pagination-container');


function generatePagination(){
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${PHP_REST_URL}/films/count`);
    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            var response = JSON.parse(xhr.responseText);
            if (xhr.status === 200){
                film_count = response.film_count;
                console.log(film_count);
                pagination_count = Math.ceil(film_count / LIMIT);
                if (pagination_count <= 5){
                    generatePagination2(pages, 1, false, false, pagination_count);
                } else {
                    if (pages < 5){
                        generatePagination2(pages, 1, false, true);
                    } else if (pages >= pagination_count-4){
                        generatePagination2(pages, pagination_count-4, true, false);
                    } else {
                        generatePagination2(pages, pages, true, true);
                    }
                }
            }
        }
    }
}


async function handlePagination(val){
    let num = Number(val);
    let sym;
    let active_button;
    let clicked_button;
    let offset;
    const pagination_buttons = document.querySelectorAll('.button-pagination');
    pagination_buttons.forEach(button => {
        console.log(button.getAttribute("value"), button.getAttribute("symbol"));
        if (Number(button.getAttribute("value")) == num){
            clicked_button = button;
            sym = button.getAttribute("symbol");
        }
        if (button.classList.contains('button-red')){
            active_button = button;
            // console.log(active_button);
        }
    })
    // console.log(num,sym);
    console.log(active_button.getAttribute("value"));
    if (sym == '>>'){
        if (Number(active_button.getAttribute("value")) == num-1){
            pagination_container.innerHTML = "";
            offset = num;
            generatePagination2(num, num-4, true, num==pagination_count?false:true);
        } else {
            active_button.classList.remove('button-red');
            active_button.classList.add('button-white');

            pagination_buttons.forEach(button => {
                if (button.getAttribute("value") == Number(active_button.getAttribute("value")) + 1){
                    button.classList.remove('button-white');
                    button.classList.add('button-red');
                    offset = (Number(button.getAttribute("value")));
                }
            })
        }
    } else if (sym == '<<' ){
        if (Number(active_button.getAttribute("value")) == (num+1)){
            console.log("sdfdfb");
            pagination_container.innerHTML = "";
            offset = num;
            generatePagination2(num, num, num==1?false:true, true);
        } else {
            console.log("nmnmn")
            console.log("num+1: ");
            console.log(num+1);
            active_button.classList.remove('button-red');
            active_button.classList.add('button-white');

            pagination_buttons.forEach(button => {
                if (button.getAttribute("value") == Number(active_button.getAttribute("value")) - 1){
                    button.classList.remove('button-white');
                    button.classList.add('button-red');
                    offset = (Number(button.getAttribute("value")));
                }
            })
        }

    } else {
        active_button.classList.remove('button-red');
        active_button.classList.add('button-white');

        clicked_button.classList.remove('button-white');
        clicked_button.classList.add('button-red');
        offset = num;
    }   

    card_container.innerHTML = "";
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${PHP_REST_URL}/films/premium-film/${offset-1}`);
    xhr.send();
    xhr.onreadystatechange = async () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            var response = JSON.parse(xhr.responseText);
            if (xhr.status === 200){
                const films = response.data;
                    films.forEach(film => {
                        card_container.innerHTML += `
                            <a href="/watch-prem/${film.film_id}">
                                <div class="card premium">
                                    <img src="storage/poster/${film.film_poster}" alt="Film Poster" />
                                </div>
                            </a>`
                });
            }
        }
}

}

console.log(PHP_REST_URL);
const xhr = new XMLHttpRequest();
xhr.open('GET', `${PHP_REST_URL}/films/premium-film/${pages-1}`);
xhr.send();
xhr.onreadystatechange = async () => {
    if (xhr.readyState === XMLHttpRequest.DONE){
        console.log(xhr.responseText);
        var response = JSON.parse(xhr.responseText);
        if (xhr.status === 200){
            console.log(response);
            const films = response.data;
                films.forEach(film => {
                    card_container.innerHTML += `
                        <a href="/watch-prem/${film.film_id}">
                            <div class="card premium">
                                <img src="storage/poster/${film.film_poster}" alt="Film Poster" />
                            </div>
                        </a>`
            });
        }
    }
}

generatePagination();