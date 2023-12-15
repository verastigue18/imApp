<?php

$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$users = new User($db, $user_id);

$user = $users->getUserById($user_id);

?>

<div id="topbar">
    <h2 id="heading"><?= $heading ?></h2>
    <div class="avatar-container">
        <span><?= $user['username']; ?></span>
    </div>
</div>