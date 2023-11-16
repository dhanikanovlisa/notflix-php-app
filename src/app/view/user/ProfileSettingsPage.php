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
    <link rel="stylesheet" type="text/css" href="/styles/components/globals.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/Navbar.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/user/profilesetting.css">
    <!---JS--->
    <script src="/javascript/user/profileSettings.js" defer></script>
</head>

<body>
    <?php include (DIRECTORY. "/../view/components/NavbarUser.php"); ?>
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
                                    if ($userData["photo_profile"] == null) {
                                        echo "/images/assets/profile-placeholder.png";
                                    } else {
                                        echo "/storage/profile/" . $userData["photo_profile"];
                                    }
                                    ?>" alt="Profile Picture" />
                        <div class="upgrade">
                            
                        <?php 
                                $status = $userDetail->checkStatus();
                                if (!($status == null)) {
                                    if($status === "PENDING"){
                                        echo '<div class="pending">' . $status . '</div>';
                                    } else if ($status === "ACCEPTED"){
                                        echo '<h3>Premium</h3>';
                                    } else if($status === "REJECTED"){
                                        echo '<button id="upgradeButton" class="button-white button-text" onclick="upgradeButtonClick()">Upgrade</button>';
                                    }
                                } else {
                                    if (!$userData["is_premium"]) {
                                        echo '<button id="upgradeButton" class="button-white button-text" onclick="upgradeButtonClick()">Upgrade</button>';
                                    } else {
                                        echo '<h3>Premium User</h3>';
                                    }
                                }
                                ?>

                        </div>
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
