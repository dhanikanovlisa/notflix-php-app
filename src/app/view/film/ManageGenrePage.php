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
    <link rel="stylesheet" type="text/css" href="/styles/components/globals.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/Navbar.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/film/manageGenre.css">
    <link rel="stylesheet" type="text/css" href="/styles/film/cardGenre.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/toast.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/pagination.css">

    <script type="text/javascript" src="/javascript/film/deleteGenre.js" defer></script>
</head>

<body>
    <?php include(DIRECTORY . "/../view/components/NavbarUser.php"); ?>
    <?php
    require_once DIRECTORY . '/../controller/film/GenreController.php';
    $genre = new GenreController();
    $result = $genre->getAllGenre();
    ?>
    <div class='container'>
        <div class='upper-container'>
            <div class="container-1">
                <h2>Genre</h2>
                <div class="">
                    <a href='/add-genre'>
                        <button class="button-white button-text">Add New Genre</button>
                    </a>
                </div>
            </div>
            <div class="container-2">
                <div class="body">
                    <div class="cards">
                        <?php $genre->generateCards() ?>
                    </div>
                    <div class="pagination">
                        <?php $genre->generatePagination() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include(DIRECTORY . "/../view/components/toast.php"); ?>
</body>

</html>