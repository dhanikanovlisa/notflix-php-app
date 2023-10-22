<?php
class Database
{
    private $host = HOST;
    private $db = DB;
    private $user = USER;
    private $pass = PASS;
    private $conn;
    private $stmt;

    /**Construct Database */
    public function __construct()
    {
        try {
            $this->conn = new PDO("pgsql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage(); //ganti exception
        }
    }

    /**Create Tables */
    private function createTables()
    {
        try {
            $this->conn->exec(
                "CREATE TABLE IF NOT EXISTS users (
                    user_id SERIAL PRIMARY KEY,
                    username VARCHAR(128) UNIQUE NOT NULL,
                    first_name VARCHAR(128) NOT NULL,
                    last_name VARCHAR(128) NOT NULL,
                    email VARCHAR(128) UNIQUE NOT NULL,
                    password VARCHAR(256) NOT NULL,
                    phone_number VARCHAR(30) NOT NULL,
                    photo_profile VARCHAR(256),
                    is_admin BOOLEAN NOT NULL
                );"
            );

            $this->conn->exec(
                "CREATE TABLE IF NOT EXISTS genre (
                    genre_id SERIAL PRIMARY KEY,
                    name VARCHAR(256) UNIQUE NOT NULL
                );"
            );

            $this->conn->exec(
                "CREATE TABLE IF NOT EXISTS film (
                    film_id SERIAL PRIMARY KEY, 
                    title VARCHAR(256) NOT NULL,
                    description TEXT,
                    film_path VARCHAR(256) NOT NULL,
                    film_poster VARCHAR(256) NOT NULL,
                    film_header VARCHAR(256) NOT NULL,
                    date_release DATE NOT NULL,
                    duration INTEGER NOT NULL
                );"
            );

            $this->conn->exec(
                "CREATE TABLE IF NOT EXISTS watchlist (
                    user_id INTEGER,
                    film_id INTEGER,
                    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users (user_id),
                    CONSTRAINT fk_film FOREIGN KEY (film_id) REFERENCES film (film_id)
                );"
            );

            $this->conn->exec(
                "CREATE TABLE IF NOT EXISTS film_genre (
                    film_id INTEGER,
                    genre_id INTEGER,
                    CONSTRAINT fk_film_genre_film FOREIGN KEY (film_id) REFERENCES film (film_id),
                    CONSTRAINT fk_film_genre_genre FOREIGN KEY (genre_id) REFERENCES genre (genre_id)
                );"
            );
        } catch (PDOException $e) {
            echo 'Error creating tables: ' . $e->getMessage();
        }
    }

    /**Prepare Query */
    public function callQuery($query)
    {
        try {
            $this->stmt = $this->conn->prepare($query);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage(); //perbaikin errornya
        }
    }

    /**Execute Query */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**Return result */
    public function fetchResult()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**Get all result */
    public function fetchAllResult()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**To Bind data for Query */
    public function bind($param, $value, $type = null)
    {
      if (is_null($type)) {
        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
            break;
        }
      }
      $this->stmt->bindParam($param, $value, $type);
    }

    /**Return Row Count */
    public function rowCount()
    {
      return $this->stmt->rowCount();
    }
    
    public function lastInsertID(){
        return $this->conn->lastInsertId();
    }
  
}