<?php

require_once DIRECTORY . '/../utils/database.php';

class FilmsModel
{
    private $table = 'film';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**Get All Film unsorted*/
    public function getAllFilm()
    {
        $this->db->callQuery('SELECT * FROM ' . $this->table);
        return $this->db->fetchAllResult();
    }

    /**Get All Film Sorted ASC/DESC*/
    public function getAllFilmSorted($attribute, $type)
    {
        if ($type == 'ASC') {
            $this->db->callQuery('SELECT * FROM ' . $this->table . ' ORDER BY ' . $attribute . ' ASC');
        } else {
            $this->db->callQuery('SELECT * FROM ' . $this->table . ' ORDER BY ' . $attribute . ' DESC');
        }
        return $this->db->fetchAllResult();
    }

    /**Get Film by ID */
    public function getFilmById($film_id)
    {
        $this->db->callQuery("SELECT * FROM film WHERE film_id = :film_id");
        $this->db->bind('film_id', $film_id);
        return $this->db->fetchResult(); 
    }


    /**Get Film by Name(String, Substring)*/
    public function getFilmByName($name)
    {
        $this->db->callQuery("SELECT * FROM film WHERE title = '$name'");
        return $this->db->fetchResult();
    }

    /**Get Film by Genre*/
    public function getFilmGenre($id)
    {
        $this->db->callQuery("
            SELECT genre.name
            FROM genre
            JOIN film_genre ON genre.genre_id = film_genre.genre_id
            JOIN film ON film_genre.film_id = film.film_id
            WHERE film.film_id = :filmid;
        ");
        $this->db->bind('filmid', $id);
        return $this->db->fetchAllResult();
    }
    

    /**Get Film by film(title), genre(name) and sort it ASC/DESC */
    public function getFilms($film_title, $genre_name, $sort_direction, $limit, $offset)
    {
        $query = "SELECT DISTINCT film.film_id, title, film_poster
                    FROM ".$this->table." INNER JOIN film_genre ON film.film_id=film_genre.film_id
                    INNER JOIN genre ON film_genre.genre_id=genre.genre_id
                WHERE title ILIKE '%".$film_title."%' ";
        if($genre_name!=="") $query .= "AND LOWER(genre.name)=LOWER('".$genre_name."') ";
        $query .= "ORDER BY title ".$sort_direction." ";
        $query .= "LIMIT :limit OFFSET :offset";
        $this->db->callQuery($query);
        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);

        return $this->db->fetchAllResult();
    }

    /**Insert Film */
    public function insertFilm($title, $description, $film_path, $film_poster, $film_header, $date_release, $duration)
    {
        $this->db->callQuery("INSERT INTO film(title, description, film_path, film_poster, film_header, date_release, duration)
            VALUES (:title, :description, :film_path, :film_poster, :film_header, :date_release, :duration);");

        $this->db->bind('title', $title);
        $this->db->bind('description', $description);
        $this->db->bind('film_path', $film_path);
        $this->db->bind('film_poster', $film_poster);
        $this->db->bind('film_header', $film_header);
        $this->db->bind('date_release', $date_release);
        $this->db->bind('duration', $duration);

        $this->db->execute();
    }

    /**Update Film */
    public function updateFilm($film_id, $data)
    {
        $sql = "
            UPDATE film
            SET title = :title,
                description = :description,
                film_path = :film_path,
                film_poster = :film_poster,
                date_release = :date_release,
                duration = :duration
            WHERE film_id = :film_id
        ";
    
        $this->db->callQuery($sql);
        $this->db->bind('title', $data['title']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('film_path', $data['film_path']);
        $this->db->bind('film_poster', $data['film_poster']);
        $this->db->bind('date_release', $data['date_release']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('film_id', $film_id);
        
        $this->db->execute();
    }
    


    /**Delete Film */
    public function deleteFilm($id)
    {
        /**Delete from watchlist */
        $this->db->callQuery('DELETE FROM watchlist WHERE film_id = ' . $id);
        $this->db->execute();
        /**Delete film genre */
        $this->db->callQuery('DELETE FROM film_genre WHERE film_id = ' . $id);
        $this->db->execute();
        /**Delete film */
        $this->db->callQuery('DELETE FROM ' . $this->table . ' WHERE film_id = ' . $id);
        $this->db->execute();
    }


    public function getLastIDFilm()
    {
        return $this->db->lastInsertID();
    }

    public function getFilmCount(){
        $this->db->callQuery('SELECT COUNT(film_id) FROM film');
        return $this->db->fetchResult();
    }

    public function getFilm($limit, $offset){
        $this->db->callQuery('SELECT * FROM film LIMIT ' . $limit . ' OFFSET ' . $offset);
        return $this->db->fetchAllResult();
    }

}
