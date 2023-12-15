<?php 
$config = require base_path('configs/db.configs.php');
$db = new Database($config['database']);

$user = new User($db);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // CHECK IF TAKEN
    if ($user->isUsernameTaken($username)) {

        $errors[] = "Username is already taken. Please choose a different username.";

    } elseif ($user->isEmailTaken($email)) {

        $errors[] = "Email is already registered. Please use a different email.";
    } else {
  
        $user->register($username, $email, $password);
        $successMessage = "Registration successful!";
    }


    
    header('Location: /login');
    exit();
  
}

require view('signup.view.php');
?>
