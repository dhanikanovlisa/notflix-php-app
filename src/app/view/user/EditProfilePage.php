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
    <link rel="stylesheet" type="text/css" href="/styles/components/confirmationModal.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/toast.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="/styles/user/editprofile.css">
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
                    <div class="detail-container">
                        <form id="editProfile">
                            <div class="container">
                                <div class="field-contain">
                                    <label class="one" for="username">Username</label>
                                    <input class="one" type="text" name="username" id="username" placeholder="<?php echo $userData["username"] ?>" autocomplete="off" />
                                    <div class="error" id="username-alert"></div>
                                </div>

                                <div class="half-container">
                                    <div class="one-half">
                                        <label for="first-name">First Name</label>
                                        <input type="text" name="first-name" id="first-name" placeholder="<?php echo $userData["first_name"] ?>" autocomplete="off" />
                                    </div>

                                    <div class="two-half">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" name="last-name" id="last-name" placeholder="<?php echo $userData["last_name"] ?>" />
                                        
                                    </div>
                                </div>
                                <div class="error" id="name-alert"></div>



                                <div class="field-contain">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="<?php echo $userData["email"] ?>" autocomplete="off"/>
                                    <div class="error" id="email-alert"></div>
                                </div>

                                <div class="field-contain">
                                    <label for="phone-number">Phone Number</label>
                                    <input type="text" name="phone-number" id="phone-number" placeholder="<?php echo $userData["phone_number"] ?>" />
                                    <div class="error" id="phone-alert"></div>
                                </div>
                                <div>
                                    <p>Profile Photo</p>
                                    <p class="text-red">File size must be less than 800KB</p>
                                    <input type="file" id="photoProfile" name="photoProfile" accept="image/*" class="inputFile"/>
                                    <label for="photoProfile" class="file-style">
                                        <div class="centered">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 448 512">
                                                <style>
                                                    svg {
                                                        fill: #fff5f6
                                                    }
                                                </style>
                                                <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z" />
                                            </svg>
                                            <p class="button-text">Upload Profile Photo</p>
                                        </div>
                                    </label>
                                    <div class="error" id="error-upload"></div>
                                    <div class="file-name" id="display-file-name"></div>
                                </div>
                                <div class="btn-contain">
                                    <div>
                                        <button type="button" class="button-red button-text" onclick="popModal()">Cancel</button>
                                        <div id="confModal" class="modal red-glow">
                                            <div class="modal-content red-glow">
                                                <div class="whole">
                                                    <div class="title-container">
                                                        <h3 class="text-black" id="main-message">Are you sure?</h3>
                                                        <p class="text-black" id="description-message">Canceling will delete all your progress</p>
                                                    </div>
                                                    <div class="button-container">
                                                        <button type="button" id="cancel" class="button-red button-text" onclick="closeModal()">Cancel</button>
                                                        <button type="button" id="ok" class="button-green button-text" onclick="closePage(<?php echo $userData['user_id']; ?>)">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="saveButton" class="button-white button-text">Save</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        var userID = <?php echo json_encode($id); ?>;
    </script>
    <script type="text/javascript" src="/javascript/user/editProfile.js" defer></script>
    <?php include(DIRECTORY. "/../view/components/toast.php"); ?>
</body>

</html>