<?php
require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/films.php';
require_once  DIRECTORY . '/../models/watchlist.php';
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
class HomePageController{ 
    private $filmModel;

    private $watchListModel;
    private $middleware;
    
    private int $limit;
    private int $page;

    public function __construct()
    {
        $this->filmModel = new FilmsModel();    
        $this->watchListModel = new WatchListModel();
        $this->middleware = new AuthenticationMiddleware();
        $this->page = isset($_GET['page']) && $_GET['page']>0 ? $_GET['page'] : 1;
        $this->limit = isset($_GET['limit']) && $_GET['limit']>0 ? $_GET['limit'] : 12;
    }

    public function showHomePage(){
        if ($this->middleware->isAdmin()) {
            header("Location: /restrictAdmin");
        } else if ($this->middleware->isAuthenticated()) {
            require_once DIRECTORY . "/../component/user/HomePage.php";
        } else {
            header("Location: /login");
        }
    }

    public function generatePagination(){
        $total_records = $this->filmModel->getFilmCount();
        if($total_records) $total_records=$total_records['count'];
        $items_per_page = 12;
        $current_page = $this->page;

        include(DIRECTORY . "/../component/template/pagination.php");
    }

    public function generateCards(){
        $offset = ($this->page-1)*$this->limit;
        $films = $this->filmModel->getFilm($this->limit, $offset);
        foreach($films as $film){
            include(DIRECTORY . "/../component/template/cardMovie.php");
        }
        if (empty($films) && $this->page == 1) echo "No film currently available";
    }

    public function filmCount(){
        return $this->filmModel->getFilmCount()['count'];
    }
    
    public function generateFilmHeader(){
        $film_count =  $this->filmModel->getFilmCount()['count'];
        $rand = rand(0, $film_count-1);
        $film = $this->filmModel->getFilm(1, $rand);
        return $film;
    }

    public function isFilmOnWatchList($user_id, $film_id){
        $film = $this->watchListModel->isFilmOnWatchList($user_id, $film_id);
        if (!$film) return false;
        else true;
    }
}