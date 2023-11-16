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
    <script type="text/javascript" src="/javascript/film/watchPrem.js" defer></script>
</head>

<body>
    <?php include(DIRECTORY. "/../view/components/NavbarUser.php"); ?>
    <section>
        <header>
            <h1 id="title-in"></h1>
        </header>
        <video controls id='video-player'>
         <!-- <source src='../storage/film/film2.mp4'  type='video/mp4'/> -->
        </video>
        <div id='details'>
            <div id='description' class='film-detail'>
                <h2>Description</h2>
                <p id="description-in"></p>
            </div>
            <div id='release' class='film-detail'>
                <h2>Release</h2>
                <p id="release-in"></p>
            </div>
            <div id='duration' class='film-detail'>
                <h2>Duration</h2>
                <p id="duration-in"></p>
            </div>
            <div id='genre' class='film-detail'>
                <h2>Genre</h2>
                <p id='genre-in'></p>
            </div>
        </div>
    </section>

</body>

</html>