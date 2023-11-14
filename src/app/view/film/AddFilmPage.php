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
    <link rel="stylesheet" type="text/css" href="/styles/components/globals.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/cardMovie.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/confirmationModal.css">
    <link rel="stylesheet" type="text/css" href="/styles/components/toast.css">
    <!---Page specify CSS--->
    <link rel="stylesheet" type="text/css" href="styles/film/addFilm.css">
    <script src="/javascript/film/addFilm.js" defer></script>
</head>

<body>
    <?php include(DIRECTORY . "/../view/components/NavbarUser.php");
    require_once DIRECTORY . '/../utils/duration.php';
    $minutes = listofMinutes();
    $hours = listofHour();

    ?>
    <div class='container'>
        <h2>Add Film</h2>
        <div class="whole-container">
            <div class="detail-container">
                <form id="addFilmForm">
                    <div class="field-container">
                        <div class="upper">
                            <div>
                                <div class="input-container">
                                    <!--Film Name-->
                                    <h3 for="filmName">Film Name<span class="req">*</span></h3>
                                    <input type="text" id="filmName" name="filmName" placeholder="Title" required />
                                    <div class="error" id="filmName-alert"></div>
                                </div>
                                <div class="input-container">
                                    <h3 for="filmDescriptsion">Description<span class="req">*</span></h3>
                                    <textarea id="filmDescription" name="filmDescription" placeholder="Description" required></textarea>
                                </div>
                            </div>
                            <div class="input-container">
                                <h3>Genre<span class="req">*</span></h3>
                                <?php
                                require_once DIRECTORY . '/../controller/film/GenreController.php';
                                $genre = new GenreController();
                                $result = $genre->getAllGenre();
                                ?>

                                <div class="grid-checkbox">

                                    <?php foreach ($result as $row) { ?>
                                        <label class="check-container" for="genre_<?php echo $row['genre_id']; ?>"><?php echo $row['name']; ?>
                                            <input type="checkbox" id="genre_<?php echo $row['genre_id']; ?>" name="filmGenre[]" value="<?php echo $row['genre_id']; ?>">
                                            <span class="checkmark"></span>

                                        </label>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                        <div>

                            <div>
                                <div class="duration-select-container">
                                    <h3>Duration</h3>
                                    <div class="border">
                                        <div class="select-container">
                                            <label for="filmHourDuration">Hour<span class="req">*</span></label>
                                            <select class="dropd" id="filmHourDuration" name="filmHourDuration">
                                                <option value="" disabled selected>HH</option>
                                                <?php
                                                foreach ($hours as $h) {
                                                ?>
                                                    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="select-container">
                                            <label for="filmMinuteDuration">Minute<span class="req">*</span></label>
                                            <select id="filmMinuteDuration" name="filmMinuteDuration">
                                                <option value="" disabled selected>MM</option>
                                                <?php

                                                foreach ($minutes as $m) {
                                                ?>
                                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="duration-select-container">

                            <h3>Release Date<span class="req">*</span></h3>
                            <label for="filmDate">Release Date</label>
                            <input type="date" id="filmDate" name="filmDate" value="" min="1950-01-01" max="2024-12-31" pattern="\d{4}-\d{2}-\d{2}" />
                        </div>
                        <div class="upload-content">
                            <!--Film Poster-->
                            <div>

                                <h3>Film Poster<span class="req">*</span></h3>
                                <p class="text-warning">File size must be below 800KB</p>
                                <input type="file" id="filmPoster" name="filmPoster" accept="image/*" class="inputFile" required />
                                <label for="filmPoster" class="file-style">
                                    <div class="centered">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 448 512">
                                            <style>
                                                svg {
                                                    fill: #fff5f6
                                                }
                                            </style>
                                            <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z" />
                                        </svg>
                                        <p class="button-text">Upload Film Poster</p>
                                    </div>
                                </label>
                                <div class="file-name" id="display-filePoster-name"></div>
                                <div class="error" id="film-poster-alert"></div>
                            </div>

                            <!--Film Video-->
                            <div>
                                <h3>Film Video<span class="req">*</span></h3>
                                <p class="text-warning">File size must be below 10MB</p>
                                <input type="file" id="filmVideo" name="filmVideo" accept="video/*" required />
                                <label for="filmVideo" class="file-style">
                                    <div class="centered">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 448 512">
                                            <style>
                                                svg {
                                                    fill: #fff5f6
                                                }
                                            </style>
                                            <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z" />
                                        </svg>
                                        <p class="button-text">Upload Film Video</p>
                                    </div>
                                </label>
                                <div class="file-name" id="display-fileVideo-name"></div>
                                <div class="error" id="film-video-alert"></div>
                            </div>
                            <div>
                                <h3>Film Header<span class="req">*</span></h3>
                                <p class="text-warning">File size must be below 800KB</p>
                                <input type="file" id="filmHeader" name="filmHeader" accept="image/*" required />
                                <label for="filmHeader" class="file-style">
                                    <div class="centered">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 448 512">
                                            <style>
                                                svg {
                                                    fill: #fff5f6
                                                }
                                            </style>
                                            <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z" />
                                        </svg>
                                        <p class="button-text">Upload Film Header</p>
                                    </div>
                                </label>
                                <div class="file-name" id="display-fileHeader-name"></div>
                                <div class="error" id="film-header-alert"></div>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="button" id="cancel" type="submit" class="button-red button-text" onclick="popModal()" aria-label="Cancel adding film">Cancel</button>
                            <div id="confModal" class="modal red-glow">
                                <div class="modal-content red-glow">
                                    <div class="whole">
                                        <div class="title-container">
                                            <h3 class="text-black" id="main-message">Are you sure?</h3>
                                            <p class="text-black" id="description-message">Canceling will delete all your progress</p>
                                        </div>
                                        <div class="button-modal-container">
                                            <button type="button" id="cancel-modal" class="button-red button-text" onclick="closeModal()" aria-label="Cancel modal">Cancel</button>
                                            <button type="button" id="ok" class="button-green button-text" onclick="closePage()" aria-label="Ok modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="saveButton" class="button-white button-text" aria-label="Saving Add Film">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    </script>
    <?php include(DIRECTORY . "/../view/components/toast.php"); ?>
</body>

</html>