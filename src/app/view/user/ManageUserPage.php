<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Notflix</title>
    <!-- Icon -->
    <link rel="icon" href="images/icon/logo.ico">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="styles/template/Navbar.css">
    <link rel="stylesheet" type="text/css" href="styles/template/cardUser.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="styles/admin/manageUser.css">
    <!-- Include the external JavaScript file -->
</head>

<body>
<?php include (DIRECTORY. "/../view/template/NavbarUser.php"); ?>
    <?php
    require_once DIRECTORY . '/../controller/user/UserController.php';
    $user = new UserController();
    $id = $_SESSION["user_id"];
    $result = $user->getAllUser();
    ?>
    <div class="container">
    <h2>Users</h2>
        <div class="cards">
        <?php foreach ($result as $user) {
            if($user['user_id'] != $id) {
                include(DIRECTORY . "/../view/template/cardUser.php");
            }
        } ?>
        </div>
    </div>
</body>
</html>