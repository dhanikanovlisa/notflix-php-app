<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/genre.php';
require_once  DIRECTORY . '/../models/filmGenre.php';
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
class GenreController
{
    private $genreModel;
    private $filmGenreModel;
    private $middleware;
    private int $limit;
    private int $page;

    public function __construct()
    {
        $this->genreModel = new GenreModel();
        $this->filmGenreModel = new FilmGenreModel();
        $this->middleware = new AuthenticationMiddleware();
        $this->page = isset($_GET['page']) && $_GET['page']>0 ? $_GET['page'] : 1;
        $this->limit = isset($_GET['limit']) && $_GET['limit']>0 ? $_GET['limit'] : 12;
    }

    public function getAllGenre()
    {
        return $this->genreModel->getAllGenre();
    }

    public function checkGenre($genreName){
        $genreName = ltrim($genreName['genre'], ':');

        $genre = $this->genreModel->getGenreByName($genreName);
        $isExist = false;
        if ($genre) {
            $isExist = true;
        }
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(["isExist" => $isExist]);
    }
    public function addGenre()
    {
        header('Content-Type: application/json');
        http_response_code(200);
        $genre = $_POST['name'];
        $this->genreModel->addGenre($genre);
        echo json_encode(["redirect_url" => "/add-genre"]);
    }

    public function deleteGenre()
    {
        header('Content-Type: application/json');
        http_response_code(200);
        $genre_id = $_POST['genre_id'];

        /**Delete genre from all film */
        $filmsWithDeletedGenre = $this->filmGenreModel->getFilmByGenreId($genre_id);
        foreach ($filmsWithDeletedGenre as $film) {
            $this->filmGenreModel->deleteFilmGenre($film['film_id']);
        }
        $this->genreModel->deleteGenre($genre_id);
        echo json_encode(["redirect_url" => "/manage-genre"]);
    }

    /**Generate pagination */
    public function generatePagination(){
        $total_records = $this->genreModel->getGenreCount();
        if($total_records) $total_records=$total_records['count'];
        $items_per_page = 12;
        $current_page = $this->page;

        include(DIRECTORY . "/../view/template/pagination.php");
    }

    public function generateCards(){
        $offset = ($this->page-1)*$this->limit;
        $genres = $this->genreModel->getGenre($this->limit, $offset);
        foreach($genres as $genre){
            include(DIRECTORY . "/../view/template/cardGenre.php");
        }
        if (empty($genres) && $this->page == 1) echo "No user currently available";
    }

    public function showManageGenrePage()
    {
        if ($this->middleware->isAdmin()) {
            include_once DIRECTORY . '/../view/film/ManageGenrePage.php';
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }

    public function addGenrePage()
    {
        if ($this->middleware->isAdmin()) {
            include_once DIRECTORY . '/../view/film/AddGenrePage.php';
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }
}
