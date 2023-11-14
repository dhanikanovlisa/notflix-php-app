<?php
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
require_once DIRECTORY . '/../models/films.php';
require_once DIRECTORY . '/../models/genre.php';
require_once DIRECTORY . '/../models/filmGenre.php';

class SearchPageController{ 
    private AuthenticationMiddleware $middleware;
    private FilmsModel $filmsModel;
    private GenreModel $genreModel;
    private string $title;
    private string $genre;
    private string $sort_direction;
    private int $page;
    private int $limit;
    private int $items_count;

    public function __construct()
    {
        $this->middleware = new AuthenticationMiddleware();
        $this->filmsModel = new FilmsModel();
        $this->genreModel = new GenreModel();
        $this->title = isset($_GET['title']) ? htmlentities($_GET['title']) : "";
        $this->genre = isset($_GET['genre']) ? htmlentities($_GET['genre']) : "";
        $this->sort_direction = isset($_GET['orderby']) ? htmlentities($_GET['orderby']) : "asc";
        $this->page = isset($_GET['page']) && $_GET['page']>0 ? htmlentities($_GET['page']) : 1;
        $this->limit = isset($_GET['limit']) && $_GET['limit']>0 ? htmlentities($_GET['limit']) : 15;
        $this->items_count = 0;
    }
    public function generateGenres(): void{
        $genres = $this->genreModel->getAllGenreSorted();
        foreach($genres as $genre){
            echo "<option value='".$genre["name"]."'>".$genre["name"]."</option>";
        }
    }
    public function generateCards(): void{
        $offset = ($this->page-1)*$this->limit;

        $lf =  $this->filmsModel->getFilms($this->title, $this->genre, $this->sort_direction, $this->limit, $offset);
        
        ob_start();
        foreach($lf as $film){
            include(DIRECTORY . "/../view/components/cardMovie.php");
            $this->items_count += 1;
        }
        $response = ob_get_contents();
        ob_end_clean();

        echo $response;
    }
    public function generatePagination(){
        $total_records = $this->items_count;
        $items_per_page = $this->limit;
        $current_page = $this->page;
        
        ob_start();
        include(DIRECTORY . "/../view/components/pagination.php");
        $response = ob_get_contents();
        ob_end_clean();

        echo $response;
    }
    public function fetchSearchResults(): void{
        echo "<div id='cards-container'>";
        $this->generateCards();
        echo "</div>";
        $this->generatePagination();
    }
    public function showSearchPage(){
        if ($this->middleware->isAdmin()) {
            header("Location: /restrictAdmin");
        } else if ($this->middleware->isAuthenticated()) {
            require_once DIRECTORY . "/../view/user/SearchPage.php";
        } else {
            header("Location: /login");
        }
    }
}