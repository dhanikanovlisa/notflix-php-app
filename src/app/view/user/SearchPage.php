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
        <link rel="stylesheet" type="text/css" href="/styles/template/navbar.css" defer>
        <link rel="stylesheet" type="text/css"href="styles/template/cardMovie.css" defer>
        <link rel="stylesheet" type="text/css"href="styles/template/pagination.css" defer>
        <!---Page specify CSS--->
        <script type="text/javascript" src="javascript/navbar/navbar.js" defer></script>
        <script type="text/javascript" src="javascript/user/search.js" defer></script>
        <link rel="stylesheet" type="text/css"href="styles/user/search.css" defer>
</head>

<body>
    <?php include (DIRECTORY. "/../component/template/NavbarUser.php");?>
    <?php
        require_once(DIRECTORY . '/../controller/search/SearchPageController.php');
        $searchPageController = new SearchPageController();
    ?>
    <section>
        <header>
            <h1>Search Film</h1>
        </header>
    
        <form name='search-film' class='search-container'>
            <div id='search-title-container'>
                <label for='title' class='white-text'>Search</label>
                <div class='icon-container'>
                    <i class='icon search-icon'></i>
                    <input name='title' id='title' type='text' placeholder='Search...'>
                </div>
            </div>
            <div id='search-orderby-container'>
                <label for='orderby' class='white-text'>Name</label>
                <div class='icon-container'>
                    <i class='icon dropdown-icon'></i>
                    <select name='orderby' id='orderby'>
                        <option value='ASC' selected>Ascending (A-Z)</option>
                        <option value='DESC'>Descending (Z-A)</option>
                    </select>
                </div>
            </div>
            <div id='search-genre-container'>
                <label for='genre' class='white-text'>Genre</label>
                <div class='icon-container'>
                    <i class='icon dropdown-icon'></i>
                    <select name='genre' id='genre'>
                        <option value='' selected></option>
                        <?php $searchPageController->generateGenres(); ?>
                    </select>
                </div>
            </div>
        </form>
        <div id='result-container' class="cards">
            <?php $searchPageController->generateCards(); ?>
        </div>

        <?php $searchPageController->generatePagination(); ?>
    </section>
    
</body>

</html>