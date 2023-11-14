<?php
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
require_once DIRECTORY . '/../models/watchlist.php';
require_once DIRECTORY . '/../models/films.php';
    
class WatchListPageController{ 
    public WatchListModel $watchListModel;
    private FilmsModel $filmsModel;
    private $middleware;
    private int $userID;
    private int $page;
    private int $limit;

    public function __construct()
    {
        $this->watchListModel = new WatchListModel();
        $this->middleware = new AuthenticationMiddleware();
        $this->filmsModel = new FilmsModel();
        $this->page = isset($_GET['page']) && $_GET['page']>0 ? $_GET['page'] : 1;
        $this->limit = isset($_GET['limit']) && $_GET['limit']>0 ? $_GET['limit'] : 15;
    }

    public function setUserID(int $userID){
        $this->userID = $userID;
    }

    public function generateCards(){
        $offset = ($this->page-1)*$this->limit;
        $lf =  $this->watchListModel->getWatchListFilms($this->userID, $this->limit, $offset);
        foreach($lf as $film){
            include(DIRECTORY . "/../view/components/cardMovie.php");
        }
        if(empty($lf) && $this->page==1) echo "Your watchlist is empty";
    }

    public function generatePagination(){
        $total_records = $this->watchListModel->getWatchListFilmsCount($this->userID);
        if($total_records) $total_records=$total_records['count'];
        $items_per_page = $this->limit;
        $current_page = $this->page;

        include(DIRECTORY . "/../view/components/pagination.php");
    }

    public function showWatchListPage()
    {
        // require_once DIRECTORY . "/../view/user/WatchListPage.php";
        if ($this->middleware->isAdmin()) {
            header("Location: /restrictAdmin");
        } else if ($this->middleware->isAuthenticated()) {
            require_once DIRECTORY . "/../view/user/WatchListPage.php";
        } else {
            header("Location: /login");
        }
    }

    public function isFilmOnWatchList($film_id){
        $film = $this->watchListModel->isFilmOnWatchList($_SESSION['user_id'], $film_id['film_id']);
        header('Content-Type: application/json');
        http_response_code(200);
        if ($film){
            echo json_encode(["isExist" => true]);
        } else {
            echo json_encode(["isExist" => false]);
        }
    }

    public function addToWatchList(){
        $this->watchListModel->addFilmToWatchList($_SESSION['user_id'], $_POST['film_id']);
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(["message" => "Movie added to watchlist"]);
    }

    public function removeFromWatchList(){
        $this->watchListModel->deleteFilmFromWatchList($_SESSION['user_id'], $_POST['film_id']);
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(["message" => "Movie removed from watchlist"]);
    }


}
