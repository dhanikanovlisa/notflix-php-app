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
    <link rel="stylesheet" type="text/css" href="/styles/components/navbar.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/film/watchFilm.css">
    <script type="text/javascript" src="/javascript/film/watchFilm.js" defer></script>
</head>

<body>
    <?php include(DIRECTORY. "/../view/components/NavbarUser.php"); ?>
    <?php
    $filmID = $params['id'];
    /**IF someone tries to access URL */
    if (!isset($filmID)) {
        $test = trim('/', $_SERVER["REQUEST_URI"]);
        $test = explode('/', $test);
        $filmID = $test[1];
    }

    $filmController = new FilmController();
    $watchlistModel = new WatchListModel();
    $filmData = $filmController->getFilmData($filmID);
    $totalRow = count($filmData);
    // print_r($_SESSION['watch_log']);
    $startTime = isset($_COOKIE['lastPlayedTime/'.$filmID]) ? $_COOKIE['lastPlayedTime/'.$filmID] : 0;

    if ($totalRow == 0) {
        require_once  DIRECTORY. '/../view/conditional/NotFound.php';
        exit;
    } else {
    ?>
    <?php
    }
    ?>
    
    <section>
        <header>
            <h1><?php echo htmlspecialchars($filmData['title']); ?></h1>
            <div class="heartcontainer">
                <div class="heart" id="heart"></div>
                <div class="likecounter"><?php $filmController->getLikesCount($filmID)?></div>
                <?php $filmController->generateWatchlistButton($filmID)?>
            </div>
        </header>
        <video controls id='video-player' >
            <?php $filmController->generateFilm($filmData['film_path'], $startTime); ?>
        </video>
        <div id='details'>
            <div id='description' class='film-detail'>
                <h2>Description</h2>
                <p><?php echo htmlspecialchars($filmData['description']) ?></p>
            </div>
            <div id='release' class='film-detail'>
                <h2>Release</h2>
                <p><?php echo htmlspecialchars($filmData['date_release']) ?></p>
            </div>
            <div id='duration' class='film-detail'>
                <h2>Duration</h2>
                <p><?php echo htmlspecialchars($filmData['duration']) ?> minutes</p>
            </div>
            <div id='genre' class='film-detail'>
                <h2>Genre</h2>
                <p><?php
                    $genres = $filmController->getFilmGenre($filmID);
                    $response = array();
                    foreach($genres as $genre){
                        array_push($response, $genre['name']);
                    }
                    echo implode(', ', $response);
                    ?>
                </p>
            </div>
        </div>
    </section>

</body>

</html>