<?php

require_once DIRECTORY . '/../utils/database.php';
class GenreModel{
    private $table = 'genre';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**Get All Genre */
    public function getAllGenre(){
        $this->db->callQuery('SELECT * FROM ' . $this->table);
        return $this->db->fetchAllResult();
    }
    /**Get All Genre sorted ascending */
    public function getAllGenreSorted(){
        $this->db->callQuery('SELECT * FROM '. $this->table .' GROUP BY genre_id ORDER BY name ASC');
        return $this->db->fetchAllResult();
    }
    /**Get genre by Name*/
    public function getGenreByName($name){
        $this->db->callQuery('SELECT * FROM genre WHERE name = :name');
        $this->db->bind('name', $name);
        return $this->db->fetchAllResult();
    }
    /**Insert new genre*/
    public function addGenre($name){
        $this->db->callQuery('INSERT INTO genre (name) VALUES (:name)');
        $this->db->bind('name', $name);
        $this->db->execute();

    }
    /**Delete genre*/
    public function deleteGenre($genre_id){
        $this->db->callQuery('DELETE FROM genre WHERE genre_id = :genre_id');
        $this->db->bind('genre_id', $genre_id);
        $this->db->execute();
    }
}