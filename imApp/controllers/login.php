<?php
$config = require base_path('configs/db.configs.php');
$db = new Database($config['database']);
$user = new User($db);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $user->login($username, $password);


    if ($result) {
        session_start();
        $_SESSION['user_id'] = $result['id'];
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        } else {
            echo 'Error';
        }
        
        

    } else {

        if ($user->isUsernameTaken($username)) {
            $errors[] = 'Incorrect password. Please try again.';
        } else {
            $errors[] = 'Username or password is incorrect. Please try again.'; 
        }
    }
}

require view('login.view.php');
?>
