<?php

class NotFoundController{ 
    public function showNotFoundPage(){
        require_once DIRECTORY . "/../view/conditional/NotFound.php";
    }
}