
<div class="card-genre">
    <div class="genre-name">
        <p class="text-contain"><?php echo $genre['name'] ?></p>
    </div>
    <button class="trash-button" onclick="popModal(<?php echo $genre['genre_id'] ?>)" aria-label="trash">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
            <style>
                svg {
                    fill: #ffffff
                }
            </style>
            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
        </svg>
    </button>
    <div id="confModal_<?php echo $genre['genre_id'] ?>" class="modal red-glow">
        <div class="modal-content red-glow">
            <div class="whole">
                <div class="title-modal-container">
                    <h3 class="text-black" id="main-message">Are you sure you want to delete genre <?php echo $genre['name'] ?>?</h3>
                    <p class="text-black" id="description-message">This will be gone</p>
                </div>
                <div class="button-modal-container">
                    <button id="cancel" class="button-red button-text" onclick="closeModal(<?php echo $genre['genre_id'] ?>)">Cancel</button>
                    <button id="ok" class="button-green button-text" onclick="deleteGenre(<?php echo $genre['genre_id'] ?>)">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>