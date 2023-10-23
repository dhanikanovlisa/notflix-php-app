<?php

require_once DIRECTORY . '/../utils/database.php';
class UserModel{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    /**Get All User */
    public function getAllUser(){
        $this->db->callQuery('SELECT * FROM ' . $this->table);
        return $this->db->fetchAllResult();
    }
    /**Get user by ID*/
    public function getUserByID($id){
        $this->db->callQuery('SELECT * FROM ' . $this->table . ' WHERE user_id = ' . $id);
        return $this->db->fetchResult();
    }

    /**Get user count */
    public function getUserCount(){
        $this->db->callQuery('SELECT COUNT(*) FROM ' . $this->table);
        return $this->db->fetchResult();   
    }

    /**Get user for pagination */
    public function getUser($limit, $offset){
        $this->db->callQuery("SELECT * FROM users LIMIT $limit OFFSET $offset");
        return $this->db->fetchAllResult();
    }

    /**Get user by username*/
    public function getUserByUsername($username){
        $this->db->callQuery("SELECT * FROM users WHERE username = '$username'");
        return $this->db->fetchResult();
    }

    /**Get user by email*/
    public function getUserByEmail($email){
        $this->db->callQuery("SELECT * FROM users WHERE email = '$email'");
        return $this->db->fetchResult();
    }

    /*Insert new user*/
    public function addUser($username, $email, $phone, $firstName, $lastName, $password){
        $this->db->callQuery("INSERT INTO users(username, first_name, last_name, email, password, phone_number, is_admin) VALUES('$username', '$firstName', '$lastName', '$email', '$password', '$phone', FALSE)");
        $this->db->execute();
    }

    /**Update User Data */
    public function updateUserData($userID, $data){
        $sql = "
            UPDATE users
            SET username = :username,
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone_number = :phone_number,
                photo_profile = :photo_profile
            WHERE user_id = :user_id
        ";
    
        $this->db->callQuery($sql);
        $this->db->bind('username', $data['username']);
        $this->db->bind('first_name', $data['first_name']);
        $this->db->bind('last_name', $data['last_name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('photo_profile', $data['photo_profile']);
        $this->db->bind('user_id', $userID);
        
        $this->db->execute();
    }

    public function changeToAdmin($userID){
        $this->db->callQuery("UPDATE users SET is_admin = TRUE WHERE user_id = :user_id");
        $this->db->bind('user_id', $userID);
        $this->db->execute();
    }

    public function changeToUser($userID){
        $this->db->callQuery("UPDATE users SET is_admin = FALSE WHERE user_id = :user_id");
        $this->db->bind('user_id', $userID);
        $this->db->execute();
    }

    /**Delete user */
    public function deleteUser($id){
        /**Delete from watchlist */
        $this->db->callQuery('DELETE FROM watchlist WHERE user_id = ' . $id);
        $this->db->execute();
        /**Delete film users */
        $this->db->callQuery('DELETE FROM users WHERE user_id = ' . $id);
        $this->db->execute();
    }

    public function isAdmin($user_id){
        $this->db->callQuery("SELECT is_admin FROM users where user_id = :user_id;");
        $this->db->bind('user_id', $user_id);
        return $this->db->fetchResult();
    }
    
}