<script type="text/javascript" src="/javascript/navbar/navbar.js" defer></script>
<nav class="navbar">
    <?php require_once  DIRECTORY . '/../middlewares/AuthenticationMiddleware.php';
    $authMiddleware = new AuthenticationMiddleware(); ?>
    <a href="<?php 
        if (!$authMiddleware->isAuthenticated()) {
            echo "/home";
        } elseif ($authMiddleware->isAdmin()){
            echo "/manage-film";
        } else {
            echo "/login";
        }
    ?>">
        <img src="/images/assets/logo_navbar.svg" class="logo" alt="logo">
    </a>
    <div class="navbar-link" id="navbar-link">
        <?php if (!$authMiddleware->isAuthenticated()) : ?>
            <a href="/home">Home</a>
            <a href="/search">Search</a>
            <a href="/watchlist">Watchlist</a>
            <button class="button-red button-text" onClick="location.href='/login';">Login</button></a>
        <?php elseif ($authMiddleware->isAdmin()) : ?>
            <a href="/manage-film">Manage Film</a>
            <a href="/manage-user">Manage User</a>
            <a href="/manage-genre">Manage Genre</a>
            <img id="photo-profile" class="photo-profile" src="<?php
                                                                require_once DIRECTORY . '/../controller/user/UserController.php';
                                                                $user = new UserController();
                                                                if (isset($_SESSION["user_id"])) {
                                                                    $user = $user->getUserByID($_SESSION["user_id"]);
                                                                    if ($user["photo_profile"] == null) {
                                                                        echo "/images/assets/profile-placeholder.png";
                                                                    } else {
                                                                        echo "/storage/profile/" . $user["photo_profile"];
                                                                    }
                                                                }
                                                                ?>" onClick="userMenu()" alt="profile picture" />
            <div class="user-menu" id="user-menu">
                <a class="hidden-link" href="/settings/<?php if (isset($_SESSION["user_id"])) {
                                                            echo $_SESSION["user_id"];
                                                        } ?>">Settings</a>
                <a class="hidden-link" onClick="logout()">Logout</a>
            </div>
        <?php else : ?>
            <a href="/home">Home</a>
            <a href="/search">Search</a>
            <a href="/watchlist">Watchlist</a>
            <a class="hidden-link" href="/settings/<?php echo $_SESSION["user_id"] ?>">Settings</a>
            <a class="hidden-link" onCLick="logout()">Logout</a>
            <img id="photo-profile" class="photo-profile" src="<?php
                                                                require_once DIRECTORY . '/../controller/user/UserController.php';
                                                                $user = new UserController();
                                                                if (isset($_SESSION["user_id"])) {
                                                                    $user = $user->getUserByID($_SESSION["user_id"]);
                                                                    if ($user["photo_profile"] == null) {
                                                                        echo "/images/assets/profile-placeholder.png";
                                                                    } else {
                                                                        echo "/storage/profile/" . $user["photo_profile"];
                                                                    }
                                                                }
                                                                ?>" onclick="userMenu()" alt="profile picture" />
            <div class="user-menu" id="user-menu">
                <a class="hidden-link" href="/settings/<?php
                                                        if (isset($_SESSION["user_id"])) {
                                                            echo $_SESSION["user_id"];
                                                        }
                                                        ?>">Settings</a>
                <a class="hidden-link" onclick="logout()">Logout</a>
            </div>
        <?php endif; ?>
    </div>
    <button class="burger-bar" onClick="navbar()">
        <img class="burger-bar" src="/images/assets/Burger bar.svg" alt="burger bar" />
    </button>
</nav>