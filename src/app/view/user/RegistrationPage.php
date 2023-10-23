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
        <link rel="stylesheet" type="text/css" href="/styles/template/globals.css">
        <link rel="stylesheet" type="text/css"href="/styles/template/navbar.css">
        <link rel="stylesheet" type="text/css" href="/styles/template/toast.css">
        <!---Page specify CSS--->
        <link rel="stylesheet" type="text/css" href="/styles/user/login.css">
        <!---JS--->
        <script type="text/javascript" src="/javascript/user/register.js" defer></script>
</head>

<body>
    <?php include (DIRECTORY. "/../component/template/NavbarUser.php");?>
    <div class="auth-page">
        <h1>Sign Up</h1>
        <form id="registration-form">
            <div class="container">
                <label class="one" for="username">Username<span class="req">*</span></label>
                <input class="one" type="text" name="username" id="username" placeholder="john_doe" required/>
                <div class="error" id="username-alert"></div>

                <label for="email">Email<span class="req">*</span></label>
                <input type="text" name="email" id="email" placeholder="johndoe@example.com" required/>
                <div class="error" id="email-alert"></div>

                <label for="phone-number">Phone Number<span class="req">*</span></label>
                <input type="text" name="phone-number" id="phone-number" placeholder="+6212345678900"required/>
                <div class="error" id="phone-alert"></div>

                <div class="half-container">
                    <div class="one-half">
                    <label for="first-name">First Name<span class="req">*</span></label>
                    <input type="text" name="first-name" id="first-name" placeholder="John" required/>
                    </div>

                    <div class="two-half">
                    <label for="last-name">Last Name<span class="req">*</span></label>
                    <input type="text" name="last-name" id="last-name" placeholder="Doe" required/>
                    </div>
                </div>
                <div class="error" id="name-alert"></div>
    
                <label for="password">Password<span class="req">*</span></label>
                <input type="password" name="password" id="password" required/>
                <div class="error" id="password-alert"></div>

                <label for="confirm-password">Confirm Password<span class="req">*</span></label>
                <input type="password" name="confirm-password" id="confirm-password" required/>
                <div class="error" id="confirm-password-alert"></div>

                <div class="submit">
                    <button class="button-red red-glow button-text" type="submit" name="login">Sign Up</button>
                </div>
            </div>
        </form>
        <div class="small-text">Already have an account? <a href="/login">Login</a></div>
    </div>
    <?php include(DIRECTORY. "/../component/template/toast.php"); ?>
</body>

</html>