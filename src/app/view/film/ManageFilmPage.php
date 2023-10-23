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
    <link rel="stylesheet" type="text/css" href="/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/cardMovie.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/pagination.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/film/manageFilm.css">
    <link rel="stylesheet" type="text/css" href="styles/user/search.css">
</head>

<body>
    <?php include (DIRECTORY. "/../view/template/NavbarUser.php"); ?>
    <?php
    require_once DIRECTORY . '/../controller/film/FilmController.php';
    $film = new FilmController();
    $result = $film->getAllFilm();
    ?>
    <div class='container'>
        <div class="upper-container">
            <h2>Film</h2>
            <a href='/add-film'>
                <button class="button-white button-text">Add New Movie</button>
            </a>
        </div>
        <div class="body">
                <div class="body-title"><h2>What Do You Want to Watch Today?</h2></div>
                <div class="cards">
                    <?php  $home->generateCards()?>
                </div>
                <div class="pagination">
                    <?php $home->generatePagination()?>
                </div>
            </div>
    </div>
</body>

</html>