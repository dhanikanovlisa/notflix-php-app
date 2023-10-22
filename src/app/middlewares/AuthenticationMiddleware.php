<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/user.php';

class AuthenticationMiddleware
{
    private $userModel;
    
    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function isAuthenticated(){
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $is_admin = $this->userModel->isAdmin($_SESSION['user_id']);

        if (!$is_admin["is_admin"]) {
            return false;
        }

        return true;
    }
}