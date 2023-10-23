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
    <link rel="stylesheet" type="text/css" href="/styles/template/toast.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/admin/userDetail.css">
    <link rel="stylesheet" type="text/css" href="/styles/template/confirmationModal.css">
    <script type="text/javascript" src="/javascript/user/detailProfile.js" defer></script>
</head>

<body>
    <?php include (DIRECTORY. "/../view/template/NavbarUser.php"); ?>
    <?php
    $id = $params['id'];
    /**IF someone tries to access URL */
    if (!isset($id)) {
        $test = trim('/', $_SERVER["REQUEST_URI"]);
        $test = explode('/', $test);
        $username = $test[1];
    }

    $userDetail = new UserController();
    $userData = $userDetail->getUserBYID($id);
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
                            <h3>Admin</h3>
                            <p><?php
                                if ($userData['is_admin']) {
                                    echo "Yes";
                                } else if (!$userData['is_admin']) {
                                    echo "No";
                                }
                                ?></p>
                        </div>
                        <div class="field-container">
                            <button type="button" class="button-red button-text" onclick="popModal()">Delete Account</button>
                            <div id="confModal" class="modal red-glow">
                                <div class="modal-content red-glow">
                                    <div class="whole">
                                        <div class="title-modal-container">
                                            <h3 class="text-black" id="main-message">Are you sure you want to Delete This?</h3>
                                            <p class="text-black" id="description-message">This will be gone</p>
                                        </div>
                                        <div class="button-modal-container">
                                            <button id="cancel" class="button-red button-text" onclick="closeModal()">Cancel</button>
                                            <button type="button" id="ok" class="button-green button-text" onclick="deleteUser(<?php echo $id; ?>)">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!$userData['is_admin']) {
                                echo "<button type='button' id='change' class='button-white button-text' onclick = 'changeToAdmin($id)'>Change To Admin</button>";
                            } else {
                                echo "<button type='button' id='change' class='button-white button-text' onclick = 'changeToUser($id)'>Change To User</button>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php
    }
    ?>
    <?php include(DIRECTORY. "/../view/template/toast.php"); ?>
</body>

</html>