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
    <link rel="stylesheet" type="text/css" href="styles/template/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/toast.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="styles/film/addGenre.css">
    <script src="/javascript/film/addGenre.js" defer></script>
</head>

<body>
    <?php include(DIRECTORY. "/../component/template/NavbarUser.php");
    ?>
    <div class='container'>
        <h2>Add Genre</h2>
        <div>
            <form id="addGenreForm">
                <div class="formcontain">
                    <div class="field-container">
                        <label for="genre">Genre Name</label>
                        <input type="text" id="genre" placeholder="Genre Name">
                        <div class="error" id="genre-alert"></div>
                    </div>
                    <div class="button-contain">
                        <button id="submitButton" class="button-red button-text">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    </script>
    <?php include(DIRECTORY. "/../component/template/toast.php"); ?>
</body>

</html>