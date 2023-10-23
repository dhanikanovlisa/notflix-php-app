<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/films.php';
require_once  DIRECTORY . '/../utils/duration.php';
require_once  DIRECTORY . '/../models/filmGenre.php';
require_once  DIRECTORY . '/../models/watchlist.php';
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
class FilmController
{
    private $filmModel;
    private $filmGenreModel;
    private $watchlistModel;
    private $middleware;

    private int $limit;
    private int $page;

    public function __construct()
    {
        $this->filmModel = new FilmsModel();
        $this->filmGenreModel = new FilmGenreModel();
        $this->watchlistModel = new WatchListModel();
        $this->middleware = new AuthenticationMiddleware();
        $this->page = isset($_GET['page']) && $_GET['page']>0 ? $_GET['page'] : 1;
        $this->limit = isset($_GET['limit']) && $_GET['limit']>0 ? $_GET['limit'] : 12;
    }

    /**Get Film */
    public function getFilmData($param)
    {
        return $this->filmModel->getFilmByID($param);
    }

    public function getAllFilm()
    {
        $filmData = $this->filmModel->getAllFilm();
        return $filmData;
    }

    public function getFilmGenre($param)
    {
        return $this->filmModel->getFilmGenre($param);
    }

    /**Check Film Name */
    public function checkFilmName($filmName)
    {
        $film_name = ltrim($filmName['filmname'], ':');
        $film_name = $this->filmModel->getFilmByName($film_name);
        $isExist = false;
        if ($film_name) {
            $isExist = true;
        }
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(["isExist" => $isExist]);
    }

    public function generatePagination(){
        $total_records = $this->filmModel->getFilmCount();
        if($total_records) $total_records=$total_records['count'];
        $items_per_page = 12;
        $current_page = $this->page;

        include(DIRECTORY . "/../view/template/pagination.php");
    }

    public function generateCards(){
        $offset = ($this->page-1)*$this->limit;
        $films = $this->filmModel->getFilm($this->limit, $offset);
        foreach($films as $film){
            include(DIRECTORY . "/../view/template/cardMovie.php");
        }
        if (empty($films) && $this->page == 1) echo "No film currently available";
    }
    
    /**Add Film */
    public function addFilm()
    {
        header('Content-Type: application/json');
        http_response_code(200);
        $convert = turnIntoMinute($_POST['filmHourDuration'], $_POST['filmMinuteDuration']);
        $this->filmModel->insertFilm(
            $_POST['title'],
            $_POST['description'],
            $_POST['film_path'],
            $_POST['film_poster'],
            $_POST['film_header'],
            $_POST['date_release'],
            $convert
        );

        $filmID = $this->filmModel->getLastIDFilm();

        foreach ($_POST['filmGenre'] as $genre) {
            $genre = intval($genre);
            $this->filmGenreModel->insertFilmGenre($filmID, $genre);
        }
        echo json_encode(["redirect_url" => "/manage-film"]);
    }

    public function editFilm()
    {
        header('Content-Type: application/json');
        http_response_code(200);

        if (empty($_POST['filmHourDuration']) && !empty($_POST['filmMinuteDuration'])) {
            $convert = turnIntoMinute(0, (int)($_POST['filmMinuteDuration']));
        } else if (empty($_POST['filmMinuteDuration']) && !empty($_POST['filmHourDuration'])) {
            $convert = turnIntoMinute($_POST['filmHourDuration'], 0);
        } else if (empty($_POST['filmHourDuration']) && empty($_POST['filmMinuteDuration'])) {
            $convert = 0;
        } else {
            $convert = turnIntoMinute((int)$_POST['filmHourDuration'], (int)$_POST['filmMinuteDuration']);
        }

        $existingFilmData = $this->filmModel->getFilmById($_POST['film_id']);
        $updateData = [];

        $updateData['title'] = $this->checkAndUpdateField($_POST['title'], $existingFilmData['title']);
        $updateData['description'] = $this->checkAndUpdateField($_POST['description'], $existingFilmData['description']);
        $updateData['duration'] = $this->checkAndUpdateField($convert, $existingFilmData['duration']);
        // $updateData['duration'] = 0;
        $updateData['film_path'] = $this->checkAndUpdateField($_POST['film_path'], $existingFilmData['film_path']);
        $updateData['film_poster'] = $this->checkAndUpdateField($_POST['film_poster'], $existingFilmData['film_poster']);
        $updateData['date_release'] = $this->checkAndUpdateField($_POST['date_release'], $existingFilmData['date_release']);


        $this->filmModel->updateFilm($_POST['film_id'], $updateData);

        // Update film genre
        if(!empty($_POST['filmGenre'])){
            $this->filmGenreModel->deleteFilmGenre($_POST['film_id']);
            foreach ($_POST['filmGenre'] as $update) {
                $this->filmGenreModel->insertFilmGenre($_POST['film_id'], $update);
            }
        }
        echo json_encode(["redirect_url" => "/detail-film/" . $_POST['film_id']]);
    }

    public function generateWatchlistButton($filmID){
        $add = "<button id='watchlist-button' class='text-black' value='add'>Add to Watchlist";
        $remove = "<button id='watchlist-button' class='text-black' value='remove'>Remove from Watchlist";
        echo ($this->watchlistModel->isFilmOnWatchList($_SESSION['user_id'],$filmID)) ? $remove:$add;
    }

    public function generateFilm($filmPath, $startTime){
        $response = "<source src='../storage/film/" . htmlspecialchars($filmPath) . '#t=' . $startTime . "' type='video/mp4'>";
        echo $response;
    }


    private function checkAndUpdateField($newData, $existingData)
    {
        if (empty($newData)) {
            return $existingData;
        } else {
            if (is_string($newData)) {
                if (strcmp($newData, $existingData) !== 0) {
                    return $newData;
                } else {
                    return $existingData;
                }
            } else if (is_int($newData)) {
                if ($newData != $existingData) {
                    return $newData;
                } else {
                    return $existingData;
                }
            }
        }
    }





    /**Delete Film */
    public function deleteFilm()
    {
        header('Content-Type: application/json');
        http_response_code(200);

        $this->filmModel->deleteFilm($_POST['film_id']);
        echo json_encode(["redirect_url" => "/manage-film"]);
    }

    /**Show Pages */
    public function showWatchFilmPage($params = [])
    {
        if ($this->middleware->isAdmin()) {
            header("Location: /restrictAdmin");
        } else if ($this->middleware->isAuthenticated()) {
            require_once DIRECTORY . "/../view/film/WatchFilmPage.php";
        } else {
            header("Location: /login");
        }
    }
    public function showDetailFilmPage($params = [])
    {
        if ($this->middleware->isAdmin()) {
            require_once DIRECTORY . "/../view/film/DetailFilmPage.php";
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }
    public function showAddFilmPage()
    {
        if ($this->middleware->isAdmin()) {
            require_once DIRECTORY . "/../view/film/AddFilmPage.php";
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }

    public function showEditFilmPage($params = [])
    {
        if ($this->middleware->isAdmin()) {
            require_once DIRECTORY . "/../view/film/EditFilmPage.php";
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }
    public function showManageFilmPage()
    {
        if ($this->middleware->isAdmin()) {
            require_once DIRECTORY . "/../view/film/ManageFilmPage.php";
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /restrict");
        } else {
            header("Location: /login");
        }
    }
}
