<?php

class RestrictedController{ 
    public function showRestrictedPage(){
        require_once DIRECTORY . "/../view/conditional/Restricted.php";
    }

    public function showAdminModePage(){
        require_once DIRECTORY . "/../view/conditional/Admin.php";
    }
}