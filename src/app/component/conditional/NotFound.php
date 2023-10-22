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
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="styles/not-found/notFound.css">
</head>

<body>
    <div class="container">
        <h1 class="text-red">404</h1>
        <h2>Page Not Found</h2>
        <?php 
        require_once  DIRECTORY . '/../controller/user/UserController.php';

        $link = '';

        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $userDetail = new UserController();
            $userData = $userDetail->getUserBYID($id);
            if ($userData['is_admin'] == 1) {
                $link = '/manage-film';
            } elseif ($userData['is_admin'] == 0) {
                $link = '/home';
            } else {
                $link = '/login';
            }
        } else {
            $link = '/login';
        }
        ?>
        <a href="<?php echo $link; ?>">
            <button class="button-red button-text red-glow"aria-label="Back To Home">Back to Home</button>
        </a>
    </div>
</body>

</html>
