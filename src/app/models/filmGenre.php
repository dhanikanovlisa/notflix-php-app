<?php

require_once DIRECTORY . '/../utils/database.php';
class FilmGenreModel{
    private $table = 'film_genre';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getFilmByGenreId($genre_id){
        $this->db->callQuery("SELECT film_id FROM film_genre WHERE genre_id = :genre_id;");
        $this->db->bind('genre_id', $genre_id);
        return $this->db->fetchAllResult();
    }

    public function insertFilmGenre($film_id, $genre_id){
        $this->db->callQuery("INSERT INTO film_genre(film_id, genre_id) VALUES (:filmid, :genreid);");
        $this->db->bind('filmid', $film_id);
        $this->db->bind('genreid', $genre_id);
        $this->db->execute();
    }

    public function deleteFilmGenre($film_id){
        $this->db->callQuery("DELETE FROM film_genre WHERE film_id = :filmid;");
        $this->db->bind('filmid', $film_id);
        $this->db->execute();
    }

    public function deleteFilmGenreByGenreID($genre_id){
        $this->db->callQuery("DELETE FROM film_genre WHERE genre_id = :genre_id;");
        $this->db->bind('genre_id', $genre_id);
        $this->db->execute();
    }
}
    