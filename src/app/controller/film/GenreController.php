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

    public function __construct()
    {
        $this->genreModel = new GenreModel();
        $this->filmGenreModel = new FilmGenreModel();
        $this->middleware = new AuthenticationMiddleware();
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

    public function showManageGenrePage()
    {
        if ($this->middleware->isAdmin()) {
            include_once DIRECTORY . '/../component/film/ManageGenrePage.php';
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }

    public function addGenrePage()
    {
        if ($this->middleware->isAdmin()) {
            include_once DIRECTORY . '/../component/film/AddGenrePage.php';
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }
}
