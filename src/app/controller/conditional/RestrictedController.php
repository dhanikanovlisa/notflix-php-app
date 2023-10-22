<?php

class RestrictedController{ 
    public function showRestrictedPage(){
        require_once DIRECTORY . "/../component/conditional/Restricted.php";
    }

    public function showAdminModePage(){
        require_once DIRECTORY . "/../component/conditional/Admin.php";
    }
}