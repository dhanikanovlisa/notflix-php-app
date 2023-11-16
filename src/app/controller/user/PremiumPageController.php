<?php
require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/films.php';
require_once  DIRECTORY . '/../models/watchlist.php';
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
require_once DIRECTORY . '/../clients/SoapClient.php';

class PremiumPageController{ 
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

    public function showPremiumPage(){
        if ($this->middleware->isAdmin()) {
            header("Location: /restrictAdmin");
        } else if ($this->middleware->isAuthenticated()) {
            require_once DIRECTORY . "/../view/user/PremiumPage.php";
        } else {
            header("Location: /login");
        }
    }

    public function generatePagination(){
        $total_records = $this->filmModel->getFilmCount();
        if($total_records) $total_records=$total_records['count'];
        $items_per_page = 12;
        $current_page = $this->page;

        include(DIRECTORY . "/../view/components/pagination.php");
    }

    public function generateCards(){
        $offset = ($this->page-1)*$this->limit;
        if (empty($films) && $this->page == 1) echo "No film currently available";
    }
}