<?php

require_once DIRECTORY . '/../utils/database.php';
class WatchListModel{
    private $table = 'watchlist';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**Get All Film in user watchlist butuh -> USER ID */
    public function getWatchList($userID){
        $this->db->callQuery('SELECT film_id FROM ' . $this->table . ' WHERE user_id = ' . $userID);
        return $this->db->fetchAllResult();
    }
    public function getWatchListFilms($userID, $limit, $offset){
        $this->db->callQuery('SELECT * FROM ' . $this->table .
                                ' NATURAL INNER JOIN film WHERE user_id = ' . $userID .
                                ' LIMIT ' . $limit . ' OFFSET ' . $offset);
        return $this->db->fetchAllResult();
    }
    public function getWatchListFilmsCount($userID){
        $this->db->callQuery('SELECT COUNT(film_id) FROM ' . $this->table .
                                ' NATURAL INNER JOIN film WHERE user_id = ' . $userID . 
                                ' GROUP BY user_id');
        return $this->db->fetchResult();
    }
    /**Add new film to watchlist */
    public function addFilmToWatchList($userID, $film_id){
        $this->db->callQuery('INSERT INTO '.$this->table.'(user_id, film_id) VALUES('.$userID.','.$film_id.')');
        return $this->db->execute();
    }
    /**Delete/remove film in watchlist */
    public function deleteFilmFromWatchList($userID, $film_id){
        $this->db->callQuery('DELETE FROM '.$this->table.' WHERE user_id='.$userID.' AND film_id='.$film_id);
        return $this->db->execute();
    }

    public function isFilmOnWatchList($user_id, $film_id){
        $this->db->callQuery('SELECT * FROM ' . $this->table . ' WHERE user_id=' . $user_id . ' AND film_id=' . $film_id);
        return $this->db->fetchResult();
    }
}