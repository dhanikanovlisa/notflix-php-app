<?php
require_once  DIRECTORY . '/../controller/user/UserController.php';

$link = '';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $userDetail = new UserController();
    $userData = $userDetail->getUserBYID($id);
    if ($userData['is_admin'] == 1) {
        $link = '/detail-film/' . $film['film_id'];
    } elseif ($userData['is_admin'] == 0) {
        $link = '/watch/' . $film['film_id'];
    } else {
        $link = '/login';
    }
} else {
    $link = '/login';
}
?>

<a href="<?php echo $link; ?>">
    <div class="card">
        <img src="storage/poster/<?php echo htmlspecialchars($film['film_poster']); ?>" alt="Film Poster" />
    </div>
</a>