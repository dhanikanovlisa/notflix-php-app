<?php

require_once  DIRECTORY . '/../utils/database.php';
require_once  DIRECTORY . '/../models/user.php';
require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';

class LoginController{ 
    private $userModel;
    private $middleware;
    public function __construct(){
        $this->userModel = new UserModel();
        $this->middleware = new AuthenticationMiddleware();
    }
    public function showLoginPage(){
        if ($this->middleware->isAdmin()) {
            header("Location: /manage-film");
        } else if ($this->middleware->isAuthenticated()) {
            header("Location: /home");
        } else {
            require_once DIRECTORY . "/../component/user/LoginPage.php";
        }
    }
    public function login(){
        $user = $this->userModel->getUserByUsername($_POST['username']);

        if ($user && password_verify($_POST['password'], $user['password'])){
            header('Content-Type: application/json');
            $is_admin = $user['is_admin'];
            $_SESSION['user_id'] = $user['user_id'];
            http_response_code(200);
            if($is_admin == 1){
                echo json_encode(["redirect_url" => "/manage-film", "message" => "Login success"]);
            } else {
                echo json_encode(["redirect_url" => "/home", "message" => "Login success"]);
            }
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Username or password is incorrect"]);
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        
        header('Content-Type: application/json');
        http_response_code(201);
    }
}