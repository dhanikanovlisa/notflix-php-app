<?php

class NotFoundController{ 
    public function showNotFoundPage(){
        require_once DIRECTORY . "/../component/conditional/NotFound.php";
    }
}