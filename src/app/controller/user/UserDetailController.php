<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/user.php';


class UserDetailController{ 
    private $userModel;
    
    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function getUserData($param){
        return $this->userModel->getUserByUsername($param);
    }

    public function showUserDetailPage($params = []){
        require_once DIRECTORY . "/../component/user/UserDetailPage.php";
    }
}