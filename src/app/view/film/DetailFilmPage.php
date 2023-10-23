<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Title--->
    <title>Notflix</title>
    <!---Icon--->
    <link rel="icon" href="/images/icon/logo.ico">
    <!---Global CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/confirmationModal.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/film/detailFilm.css">
    <script type="text/javascript" src="/javascript/film/deleteFilm.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/styles/template/toast.css">
</head>

<body>
    <?php include(DIRECTORY. "/../view/template/NavbarUser.php"); ?>
    <?php

    $filmID = $params['id'];
    /**IF someone tries to access URL */
    if (!isset($filmID)) {
        $test = trim('/', $_SERVER["REQUEST_URI"]);
        $test = explode('/', $test);
        $filmID = $test[1];
    }

    $filmDetail = new FilmController();
    $filmData = $filmDetail->getFilmData($filmID);
    $filmGenre = $filmDetail->getFilmGenre($filmID);
    $totalRow = count($filmData);
    ?>
    <div id="" class='container'>
        <?php
        if ($totalRow == 0) {
            require_once DIRECTORY . '/../view/conditional/NotFound.php';
            exit;
        } else {
        ?>
            <div class='outer-container'>
                <div class="title-container">
                    <h2><?php echo $filmData["title"] ?></h2>
                </div>
                <div class="whole-container">
                    <div class="image-container">
                        <div class="card">
                            <?php
                            $urlPhoto = "/storage/poster/" . $filmData["film_poster"];

                            ?>
                            <img src="<?php echo $urlPhoto; ?>" alt="Film Image" />
                        </div>
                    </div>
                    <div class="detail-container">
                        <div class="field-container">
                            <h3>Description</h3>
                            <p><?php echo $filmData["description"] ?></p>
                            <h3>Genre</h3>
                            <div class="description-container">
                                <?php
                                echo "<p>" . implode(", ", array_column($filmGenre, "name")) . "</p>";
                                ?>
                            </div>
                            <h3>Release Year</h3>
                            <p><?php echo $filmData["date_release"] ?></p>
                            <h3>Duration</h3>
                            <?php
                            require_once DIRECTORY . '/../utils/duration.php';
                            $result = turnToHourAndMinute($filmData["duration"]);
                            echo "<p>" . $result["hour"] . " hour " . $result["minute"] . " minute </p>";
                            ?>

                        </div>
                        <div class="button-container">
                            <button id="deleteButton" class="button-red button-text" onclick="popModal()">Delete</button>
                            <div id="confModal" class="modal red-glow">
                                <div class="modal-content red-glow">
                                    <div class="whole">
                                        <div class="title-modal-container">
                                            <h3 class="text-black" id="main-message">Are you sure you want to delete <?php echo $filmData['title']?>?</h3>
                                            <p class="text-black" id="description-message">This will be gone</p>
                                        </div>
                                        <div class="button-modal-container">
                                            <button id="cancel" class="button-red button-text" onClick="closeModal()">Cancel</button>
                                            <button id="ok" class="button-green button-text" onclick="deleteSong(<?php echo $filmID; ?>)">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/edit-film/<?php echo $filmID; ?>">
                                <button class="button-white button-text">Edit</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        
    </div>
    <?php include(DIRECTORY. "/../view/template/toast.php"); ?>
</body>


</html>