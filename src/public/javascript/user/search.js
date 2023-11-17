const form = document.forms['search-film'];
const GETParams = new URLSearchParams(window.location.search);

const search = form.elements['title'];
search.value = GETParams.get('title');
const orderby = form.elements['orderby'];
orderby.value = GETParams.get('orderby') ? GETParams.get('orderby') : orderby.value;
const genre = form.elements['genre'];
genre.value = GETParams.get('genre');

const fetchResults = ()=>{
    const xhr = new XMLHttpRequest();
    const params = new URLSearchParams();
    params.set('title', search.value);
    params.set('orderby', orderby.value);
    params.set('genre', genre.value);

    const location = '/search/film?'+params.toString();
    xhr.open('GET', location, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();

    xhr.onreadystatechange = async (ev)=>{
        if(xhr.readyState !== XMLHttpRequest.DONE) return;
        if(xhr.status==200){
            const resultContainer = document.getElementById('result-container');
            const paginationContainer = document.getElementById('pagination-container');
            const doc = new DOMParser().parseFromString(xhr.responseText, 'text/html');
            const films = doc.getElementById('cards-container').children;

            const pagination = doc.getElementById('pagination-container');

            resultContainer.innerHTML = '';
            for(film of films){
                resultContainer.innerHTML += film.outerHTML;
            }
            if(!resultContainer.innerHTML){
                resultContainer.innerHTML = 'Movie not found';
            }

            paginationContainer.innerHTML = pagination.outerHTML;
            // window.history.replaceState(null, document.title, '/search?'+params.toString());
        }
    }
}

let timeoutId = null;
const debounce = (func, delay) => {
    return async ()=>{
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(), delay);
    }
}

const searchDebounce = debounce(fetchResults, 500);

search.addEventListener('input', (ev)=>{
    ev.preventDefault();
    searchDebounce();
});

orderby.addEventListener('change', (ev)=>{
    ev.preventDefault();
    searchDebounce();
});

genre.addEventListener('change', (ev)=>{
    ev.preventDefault();
    searchDebounce();
});