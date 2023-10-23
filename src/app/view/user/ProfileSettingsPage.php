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
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/user/profilesetting.css">
</head>

<body>
    <?php include (DIRECTORY. "/../view/template/NavbarUser.php"); ?>
    <?php
    require_once DIRECTORY . '/../controller/user/UserController.php';

    
    $id = $params["id"];
    /**IF someone tries to access URL */
    $userDetail = new UserController();
    $userData = $userDetail->getUserByID($id);
    $totalRow = count($userData);

    if ($totalRow == 0) {
        require_once  DIRECTORY . '/../view/conditional/NotFound.php';
        exit;
    } else {
    ?>
        <div class='outer-container'>
            <div class="upper-container">
                <div class="header">
                    <h1>Profile</h1>
                </div>
                <div class="whole-container">
                    <div class="profile">
                        <img src="<?php
                                    if ($user["photo_profile"] == null) {
                                        echo "/images/assets/profile-placeholder.png";
                                    } else {
                                        echo "/storage/profile/" . $user["photo_profile"];
                                    }
                                    ?>" alt="Profile Picture" />
                    </div>

                    <div class="detail-container">

                        <div class="field-container">
                            <h3>Username</h3>
                            <p><?php echo $userData['username']; ?></p>
                        </div>
                        <div class="field-container">
                            <h3>Name</h3>
                            <p><?php echo $userData['first_name'] . " " .  $userData['last_name']; ?></p>
                        </div>
                        <div class="field-container">
                            <h3>Email</h3>
                            <p><?php echo $userData['email'] ?></p>
                        </div>
                        <div class="field-container">
                            <h3>Phone Number</h3>
                            <p><?php echo $userData['phone_number'] ?></p>
                        </div>
                        <div class="field-container">
                            <a href="/edit-profile/<?php echo $id ?>">
                                <button class="button-white button-text">Edit Profile</button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>