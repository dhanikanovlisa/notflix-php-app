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
    <link rel="stylesheet" type="text/css" href="styles/components/globals.css">
    <link rel="stylesheet" type="text/css" href="styles/components/Navbar.css">
    <link rel="stylesheet" type="text/css" href="styles/components/cardUser.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/pagination.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="styles/admin/manageUser.css">
    <!-- Include the external JavaScript file -->
</head>

<body>
    <?php include(DIRECTORY . "/../view/components/NavbarUser.php"); ?>
    <?php
    require_once DIRECTORY . '/../controller/user/UserController.php';
    $user = new UserController();
    $id = $_SESSION["user_id"];
    ?>
    <div class="container">
        <h2>Users</h2>
        <div class="body">
            <div class="cards">
                <?php $user->generateCards() ?>
            </div>
            <div class="pagination">
                <?php $user->generatePagination() ?>
            </div>
        </div>
    </div>
</body>

</html>