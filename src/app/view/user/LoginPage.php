<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Title--->
    <title>Login</title>
    <!---Icon--->
    <link rel="icon" href="images/icon/logo.ico">
    <!---Global CSS--->
    <link rel="stylesheet" type="text/css" href="styles/components/globals.css">
    <link rel="stylesheet" type="text/css" href="styles/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="styles/components/loading.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="styles/user/login.css">
    <!--JS-->
    <script type="text/javascript" src="javascript/user/login.js" defer></script>
    <script type="text/javascript" defer>
        let CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
</head>

<body>
    <?php include(DIRECTORY . "/../view/components/NavbarUser.php"); ?>
    <?php include(DIRECTORY . "/../view/components/loading.php"); ?>
    <div class="auth-page">
        <h1>Login</h1>
        <form id="login-form">
            <div class="container">
                <label for="username">Username<span class="req">*</span></label>
                <input type="text" name="username" id="username" required />

                <label for="password">Password<span class="req">*</span></label>
                <input type="password" name="password" id="password" required />
                <div class="error login" id="login-alert"></div>

                <div class="submit">
                    <button class="button-red red-glow button-text" type="submit" name="login">Login</button>
                </div>
            </div>
            <div class="small-text">Already have an account? <a href="/registration">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>