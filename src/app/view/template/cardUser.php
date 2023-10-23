<a class="card-link" href="user-detail/<?php echo $user['user_id']; ?>">
    <div class="card-box red-glow">
        <div class="profile-container">
        <div class="profile-shape">
            <img src="<?php echo "/storage/profile/" . $user['photo_profile']?>" alt="Profile Picture" />
        </div>
        <div class="text-div">
            <h3 class="text-white"><?php echo $user["name"]; ?></h3>
            <p class="text-white"><?php echo $user["role"]; ?></p>
        </div>
        </div>
    </div>
</a>