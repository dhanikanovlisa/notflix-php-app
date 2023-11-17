<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/user.php';
require_once DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';

class RegistrationController{ 
    private $userModel;
    private $middleware;
    public function __construct(){
        $this->userModel = new UserModel();
        $this->middleware = new AuthenticationMiddleware();
    }
    public function showRegistrationPage(){
        if ($this->middleware->isAdmin()) {
            header("Location: /manage-film");
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /home");
        } else {
            require_once DIRECTORY . "/../view/user/RegistrationPage.php";
        }
    }

    public function register(){
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(["redirect_url" => "/login"]);
        $this->userModel->addUser($_POST['username'],$_POST['email'], $_POST['phone'],$_POST['firstName'], $_POST['lastName'], password_hash($_POST['password'], PASSWORD_DEFAULT));
    }
}