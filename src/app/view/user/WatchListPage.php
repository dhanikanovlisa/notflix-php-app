<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---Title--->
        <title>Notflix</title>
        <!---Icon--->
        <link rel="icon" href="images/icon/logo.ico">
        <!---Global CSS--->
        <link rel="stylesheet" type="text/css" href="styles/template/globals.css">
        <link rel="stylesheet" type="text/css"href="styles/template/Navbar.css">
        <link rel="stylesheet" type="text/css"href="styles/template/cardMovie.css">
        <link rel="stylesheet" type="text/css"href="styles/template/pagination.css">
        <!---Page specify CSS--->
        <link rel="stylesheet" type="text/css"href="styles/user/watchlist.css">
</head>

<body>
    <?php include (DIRECTORY. "/../component/template/NavbarUser.php");?>
    <?php 
        require_once DIRECTORY . '/../controller/watchlist/WatchListPageController.php';
        $watchListPageController = new WatchListPageController();
        // $_SESSION['user_id']=5;
        $watchListPageController->setUserID($_SESSION['user_id']);
    ?>
    <section>
        <header>
            <h1>Your Watchlist</h1>
        </header>
        <div class='cards'>
            <?php 
                $watchListPageController->generateCards();
            ?>
        </div>

        <?php 
            $watchListPageController->generatePagination();
        ?>
    </section>
</body>

</html>