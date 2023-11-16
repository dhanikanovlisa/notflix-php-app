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
    <link rel="stylesheet" type="text/css" href="/styles/components/cardMovie.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/toast.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/pagination.css">
    <link rel="stylesheet" type="text/css" href="styles/components/loading.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/user/premium.css">
    <!-- JS --->
    <script type="text/javascript" src="/javascript/user/premiumFilm.js" defer></script>
</head>
<body>
    <?php include (DIRECTORY. "/../view/components/NavbarUser.php"); ?>
    <?php include(DIRECTORY . "/../view/components/loading.php"); ?>
    <section>
        <header>
            <h1>Premium Film</h1>
        </header>
        <div id='result-container' class="cards">
        </div>
        <div id='pagination-container' class='pagination'>
        </div>
    </section>
</body>

</html>